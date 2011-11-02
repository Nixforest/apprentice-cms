<?php

/**
 *	class manage role
 *	
 */

require_once '/../models/BsRole.php';
require_once '/../forms/AddRoleForm.php';
require_once '/../models/RoleEntity.php';
require_once '/../models/Privilege.php';

class Admin_RoleController extends Zend_Controller_Action{
	/**
 	 *	view table
 	 *	@return void
 	 */
	public function listAction()
	{
		$role=new Model_BsRole();
		//$result=$role->getAllRole();
		$result=$role->numbUsers();	//number of Users
		$this->view->result=$result;
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
					$error[]="$name has been registed, please try again";
					$this->view->error = $error;
				}
				else
				{
					$role->addRole($table, $mod->data);
				}
				
				//process the data
	           	$this->_redirector = $this->_helper->getHelper('Redirector');
				$this->_redirector->gotoUrl('../public/admin/role/list');
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
			$role->deleteRole($role_id);
			//process the data
	   		$this->_redirector = $this->_helper->getHelper('Redirector');
			$this->_redirector->gotoUrl('../public/admin/role/list');
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function permissionAction()
	{
		$priArr =null;
		$roleId = (int)$_GET['roleId'];
		$this->view->roleId = $roleId;
		$priviModel = new Model_Privilege();
		$ruleModel = new Model_DbRole();	
		$db = Zend_Registry::get('connectDb');
		$priAllowQuery = $ruleModel->getPriAllow($roleId);
		$priAllowResult = $db->query($priAllowQuery);
		while($row = $priAllowResult->fetch()){
			$priArr[] = $row['privilege_id'];
		}
		$this->view->priArr = $priArr;
		

		//Danh sach cac module:
		$moduleQuery = $priviModel->getModuleName();
		$moduleResult = $db->query($moduleQuery);
		$this->view->moduleResult = $moduleResult;
		
		if(isset($_GET['modulename'])){
			$moduleName = (string)$_GET['modulename'];
			$desQuery = $priviModel->getPrivilege($moduleName);
			$desResult = $db->query($desQuery);
			
			while($row = $desResult->fetch()){
				$idArr[]= $row['privilege_id'];
			}							
			$desResult = $db->query($desQuery);
			$this->view->desResult = $desResult;
		}
		
		if(isset($_GET['action'])){
				if($_GET['action']==="Allow"){
				$id=$_GET['id'];
				$addRule = $ruleModel->addRule($roleId, 'role', $id, 1);
				$addRuleResult = $db->query($addRule);
			}
			else{
				$id=$_GET['id'];
				$delRule = $ruleModel->delRule($id);
				$delRuleResult = $db->query($delRule);
			}
		}			
	}
}


