<?php

/**
 *	class manage role
 *	
 */

require_once '/../models/BsRole.php';
require_once '/../forms/AddRoleForm.php';
require_once '/../models/RoleEntity.php';

class Admin_RoleController extends Zend_Controller_Action{
	/**
 	 *	view table
 	 *	@return void
 	 */
	public function listAction()
	{
		$role=new Model_BsRole();
		$result=$role->getAllRole();
		$this->view->result=$result;
	}
	
	public function submitAction()
	{
		$frmAddRole=new Form_AddRoleForm();
		$frmAddRole->setAction('http://localhost/Apprentice_CMS/public/admin/role/submit');
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
				$role->addRole($table, $mod->data);
				
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
	
	public function permissionAction()
	{
		
	}
}


