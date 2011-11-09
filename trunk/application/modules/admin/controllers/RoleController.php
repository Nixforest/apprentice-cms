<?php

/**
 *	class manage role
 *	
 */

require_once '/../models/BsRole.php';
require_once '/../forms/AddRoleForm.php';
require_once '/../models/RoleEntity.php';
require_once '/../models/Privilege.php';
require_once 'acl/acl.php';

class Admin_RoleController extends Zend_Controller_Action{
	/**
 	 *	view table
 	 *	@return void
 	 */
	
	//check login
	public function preDispatch()
	{
		$auth=Zend_Auth::getInstance();
		if(!$auth->hasIdentity())
		{
			$this->_redirect('/admin/auth/login');
		}
		else
		{
			$userdata=$auth->getIdentity();
			$this->user_name=$userdata->user_name;
			$this->user_role=$userdata->role_id;
		}
	}
	
	//cap quyen cho view role
	public function listAction()
	{
		//Access check
		//$acl=Zend_Registry::get('acl');
		$acl=new ResAcl();
		$controller=$this->getRequest()->getControllerName();
		if (!$acl->isAllowed($this->user_role,'role')) {
			$this->_redirect('/static/noaccess');
		}
		
		else{
			//add some code to list controller
			$role=new Model_BsRole();
			//$result=$role->getAllRole();
			$result=$role->numbUsers();	//number of Users
			$this->view->result=$result;
		}
	}
	
	public function submitAction()
	{
		$frmAddRole=new Form_AddRoleForm();
		$frmAddRole->setAction('../role/submit');
		$frmAddRole->setMethod('post');
		if($this->getRequest()->isPost())
		{
			if($frmAddRole->isValid($_POST))
			{
				//just dump the data for now
				$data=$frmAddRole->getValues();
				
				try {
					$db = Zend_Registry::get('connectDb');
					$name=$frmAddRole->getValue('name');
					$description=$frmAddRole->getValue('description');
					$locked=$frmAddRole->getValue('locked');
					
					$role=new Model_BsRole();
					$mod=new Model_RoleEntity();
					$mod->set('name', $name);
					$mod->set('description',$description);
					$mod->set('locked',$locked);
					$table='admin_role';
					if($role->checkNameRole($name)>0)
					{
						echo "$name has been registed, please try again";
					}
					else
					{
						$role->addRole($table, $mod->data);
						//process the data
	           			$this->_redirector = $this->_helper->getHelper('Redirector');
						$this->_redirector->gotoUrl('../public/admin/role/list');
					}
				}
				catch (Zend_Db_Exception $e)
				{
					echo $e->getMessage();
				}
			}
		}
		
		$this->view->form=$frmAddRole;
	}
	
	public  function installAction()//hàm chạy phần install
	{	
		//gọi phương thức instal cần truyền tên module vào.	
		$settup = new Model_BsRole();
		$settup->install('admin');
	}
	
	//lock action
	public function lockAction()
	{
		$role_id = $this->_request->getParam("id");
		$role = new Model_BsRole();
		$role->lockRole($role_id);
		//process the data
	    $this->_redirector = $this->_helper->getHelper('Redirector');
		$this->_redirector->gotoUrl('../public/admin/role/list');
	}
	
	//unlock action
	public function unlockAction()
	{
		$role_id = $this->_request->getParam("id");
		$role = new Model_BsRole();
		$role->unlockRole($role_id);
		//process the data
	    $this->_redirector = $this->_helper->getHelper('Redirector');
		$this->_redirector->gotoUrl('../public/admin/role/list');
	}
	
	//delete action
	public function removeAction()
	{
		try {
			$role_id = $this->_request->getParam("id");
			$role = new Model_BsRole();
			if($role->numCurrentUsers($role_id)==0)
			{
				$role->deleteRole($role_id);
				//process the data
	   			$this->_redirector = $this->_helper->getHelper('Redirector');
				$this->_redirector->gotoUrl('../public/admin/role/list');
			}
			else
			{
				echo 'Not delete because role is used';		
			}
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function permissionAction()
	{
		$priArr[] =0;		//Mang luu id cac quyen cua role
		$roleId = (int)$_GET['roleId'];
		$this->view->roleId = $roleId;
		$priDb = new Model_Privilege();
		$ruleDb = new Model_DbRole();	
		
		//Lay cac quyen cua 1 nhom nguoi dung va luu vao mang:
		$priAllowResult = $ruleDb->getPrivilegeIdAllow($roleId,'role');
		while($row = $priAllowResult->fetch()){
			$priArr[] = $row['privilege_id'];
		}
		$this->view->priArr = $priArr;
		$priArr[]=null;

		//Danh sach cac module:
		$moduleResult = $priDb->getModuleName();
		$this->view->moduleResult = $moduleResult;
		
		//click vao 1 module item:
		if(isset($_GET['modulename'])){
			$moduleName = (string)$_GET['modulename'];
			$priResult = $priDb->getPrivilege($moduleName);						
			
			//Add cac quyen da co cua role vao mang de kiem tra:
			while($row = $priResult->fetch()){
				$priArray[]= $row['privilege_id'];
			}	
			
			//Luu cac ten controller o trong module vao mang:
			$conResult = $priDb->getControllerName($moduleName);
			while($row = $conResult->fetch()){
				$conArray[]=$row['controller_name'];
			}
			$this->view->conArray = $conArray;
		
			//click vao submit button save:
			if( $this->getRequest()->isPost()){
				foreach($priArray as $id){
					if(isset($_POST[$id])){
						//Role chua co quyen thi add quyen do cho role:
						if($ruleDb->checkPrivilege($roleId,'role', $id)==0)
							$addRuleResult = $ruleDb->addRule($roleId, 'role', $id, 1);
					}
					else
						$ruleDb->deleleRule($roleId,$id,'role');				
				}			
				$this->_redirect('admin/role/permission?roleId='.$roleId);
			}
			
			$priResult = $priDb->getPrivilege($moduleName);
			$this->view->desResult = $priResult;									
		}							
	}
}


