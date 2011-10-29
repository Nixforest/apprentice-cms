<?php

/**
 *	class manage role
 *	
 */

require_once '/../models/role.php';

class Admin_RoleController extends Zend_Controller_Action{
	/**
 	 *	view table
 	 *	@return void
 	 */
	public function listAction()
	{
		$db=new Zend_Db_Adapter_Pdo_Mysql(array(
												'host'		=>	'localhost',
												'username'	=>	'apprentice',
												'password'	=>	'apprentice',
												'dbname'	=>	'apprentice_cms'));
		try {
			$db->getConnection();
		}
		catch (Zend_Db_Adapter_Exception $e){
			echo 'Error';
		}
		catch (Zend_Exception $e) {
    		echo 'Error2';
		}
		$stmt=$db->query('SELECT * FROM admin_role');
		$db->closeConnection();
		$this->view->result=$stmt;
		
		/*$query = "select * from admin_role;";
		$db = Zend_Registry::get('connectDb');
		$result = $db->query($query);
		$this->view->result=$result;
		*/
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
				
				/*$sql = sprintf("INSERT INTO admin_role(name, description, locked)
						VALUES ('%s', '%s', '%s')",
						$name,
						$description,
						'1');
				$db=$this->getDefaultAdapter();
				$db->query($sql)or die("Can not insert database ");*/ 
		
				//insert rows
				
				$row=array('name'=>$name,'description'=>$description,'locked'=>$locked);
				$table = 'admin_role';
				$db->insert($table,$row);
				
				//update rows
				/*$set = array('name'=>$name,'description'=>$description);
				$table = 'admin_role';
				$where=$db->quoteInto('name=?','admin');
				$db->update($table,$set,$where);*/
				
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
	public function permissionAction()
	{
		
	}
}


