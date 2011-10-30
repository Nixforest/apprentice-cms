<?php
require_once '/../models/DbRole.php';

class Model_BsRole{
	public function getAllRole()
	{
		$module= new Model_DbRole();
		return $module->getAllRole();
	}
	public function addRole($table,$row) 
	{
		$module= new Model_DbRole();
		$module->addRole($table,$row);
	}
}