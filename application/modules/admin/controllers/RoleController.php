<?php

/**
 *	class manage role
 *	
 */

require_once 'acl/acl.php';

class Admin_RoleController extends Zend_Controller_Action{
	/**
 	 *	view table
 	 *	@return void
 	 */

	
	public  function init()
	{
	$autoLoader = Zend_Loader_Autoloader::getInstance(); 
    $autoLoader->registerNamespace('CMS_'); 
    $resourceLoader = new Zend_Loader_Autoloader_Resource(array( 
        'basePath'      => APPLICATION_PATH . '/modules/admin', 
        'namespace'     => '', 
        'resourceTypes' => array( 
            'form' => array( 
                'path'      => 'forms/', 
                'namespace' => 'Form_', 
            ), 
	 'model' => array( 
                'path'      => 'models/', 
                'namespace' => 'Model_' 
            ),              
        ), 
    ));
    return $autoLoader; 
	}
	

	
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
		$priAllowArray[] =null;		//Mang luu id cac quyen da co cua role
		$roleId= (int)$this->_request->getParam('id');
		$this->view->roleId = $roleId;		
		$priDb = new Model_Privilege();
		$ruleDb = new Model_Rule();	
		$roleDb = new Model_UserModel();
		
		//Lay cac quyen cua 1 nhom nguoi dung va luu vao mang:
		$priAllowResult = $ruleDb->getPrivilegeIdAllow($roleId,'role');
		while($row = $priAllowResult->fetch()){
			$priAllowArray[] = $row['privilege_id'];
		}
		$this->view->priAllowArray = $priAllowArray;

		//Danh sach cac module:
		$moduleResult = $priDb->getModuleName();
		$this->view->moduleResult = $moduleResult;
		
		//click vao 1 module item:
		if(isset($_GET['modulename'])){
			$moduleName = (string)$_GET['modulename'];
			$priResult = $priDb->getPrivilege($moduleName);						
						
			//Luu cac ten controller o trong module vao mang:
			$conResult = $priDb->getControllerName($moduleName);
			while($row = $conResult->fetch()){
				$conArray[]=$row['controller_name'];
			}
			$this->view->conArray = $conArray;
		
			//Add cac quyen da co cua role vao mang de kiem tra:
			while($row = $priResult->fetch()){
				$priArray[]= $row['privilege_id'];
			}	
			
			//click vao submit button save:
			if( $this->getRequest()->isPost()){
				foreach($priArray as $priId){
					if(isset($_POST[$priId])){
						//Role chua co quyen thi add quyen do cho role:
						if($ruleDb->checkPrivilege($roleId,'role', $priId)==0)
							$addRuleResult = $ruleDb->addRule($roleId, 'role', $priId, 1);
					}
					else{
						//Xoa quyen cua role tuong ung:
						if($ruleDb->checkPrivilege($roleId,'role', $priId)>=1)
							$ruleDb->deleleRuleAtPriId($roleId,$priId,'role');
						
					    //lay danh sach cac Id cua role luu vao mang:
						$userIdResult = $roleDb->getUserIdFromRole($roleId);	
						while($row = $userIdResult->fetch()){
							$userIdArray[] = $row['user_id'];
						}
						
						//Xoa quyen cua cac user thuoc role tuong ung:
						foreach ($userIdArray as $userId){
							if($ruleDb->checkPrivilege($userId,'user', $priId)>=1)
								$ruleDb->deleleRuleAtPriId($userId,$priId,'user');
						}
					}		
				}			
				$this->_redirect('admin/role/permission/id/'.$roleId);
			}
			//truyen danh sach cac quyen cua module qua view:
			$priResult = $priDb->getPrivilege($moduleName);
			$this->view->privilegeResult = $priResult;									
		}							
	}
}


