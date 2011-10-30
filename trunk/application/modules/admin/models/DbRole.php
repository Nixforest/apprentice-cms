<?php
require_once '/../models/BsRole.php';

class Model_DbRole extends Zend_Db_Table_Abstract{
	protected $_name='role';
	
	public function getAllRole()
	{
		$sql='SELECT * FROM admin_role';
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
	}
	
	public function addRole($table,$row)
	{
		//insert rows
		$db=$this->getDefaultAdapter();
		$db->insert($table,$row);
	}
}