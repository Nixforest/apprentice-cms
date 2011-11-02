<?php
require_once '/../models/DbRole.php';
require_once '/../models/RoleEntity.php';

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
	
	public function lockRole($id)
	{
		$module= new Model_DbRole();
		$module->lock($id);
	}
	
	public function unlockRole($id)
	{
		$module= new Model_DbRole();
		$module->unlock($id);
	}
	
	public function checkNameRole($name)
	{
		$module= new Model_DbRole();
		return $module->checkNameRole($name);
	}
	
	public function numbUsers()
	{
		$module= new Model_DbRole();
		return $module->numbUsers();
	}
	
	public function numCurrentUsers($id)
	{
		$module= new Model_DbRole();
		return $module->numCurrentUsers($id);
	}
	
	public function deleteRole($id)
	{
		$module= new Model_DbRole();
		$module->deleteRole($id);
	}
	
	public function install($module)
	{
		$file = APPLICATION_PATH .'\modules\\'. $module . '\config' .'\about.xml';
		if (!file_exists($file)) {
			return null;
		}
		$xml = simplexml_load_file($file);
		$moduleObj = new Model_RoleEntity();
		$moduleObj->setdata(array(
			'name' 		  => strtolower($xml->name),
			'description' => $xml->description,
			'locked'   	  => $xml->locked,
		));		
		
		$file1 = APPLICATION_PATH .'\modules\\'. $module .'\install\RoleMySQL.sql';
		$fp=fopen($file1,"r"); 
		$contents = fread ($fp, filesize($file1)); 
		fclose($fp);  
		$db = Zend_Registry::get('connectDb');
		$rst= explode("$$", $contents);
	
		foreach ($rst as $row)
		{
			try 
			{
				$result =$db->query($row)or die("Can not create database "); 
			} 
			catch (Exception $e) {
			}
		}
		echo 'Cac thuoc tinh trong xml:<br>';
		print_r($moduleObj->data);
		return  $moduleObj;	
	}
}