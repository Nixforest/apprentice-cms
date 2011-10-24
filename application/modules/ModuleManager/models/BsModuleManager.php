<?php
class Model_BsModuleManager//lớp thao tác chung của module
{
	public function getdata()
	{
		$module= new Model_DbModuleManager();
		return $module->getModules();
	}
	public function addmodule($data) 
	{
		$module= new Model_DbModuleManager();
		$module->addmodule($data);
	}
	public function deletemodule($name)
	{
		$module = new Model_DbModuleManager();
		$module->deletemodule($name);
	}
    public function install($module)
	{
		$file = APPLICATION_PATH .'\modules\\'. $module . '\config' .'\about.xml';
		if (!file_exists($file)) {
			return null;
		}
		$xml = simplexml_load_file($file);
		$moduleObj = new Model_ModuleManagerEntity();
		$moduleObj->setdata(array(
			'name' 		  => strtolower($xml->name),
			'description' => $xml->description,
			'thumbnail'   => $xml->thumbnail,
			'author' 	  => $xml->author,
			'email' 	  => $xml->email,
			'version' 	  => $xml->version,
			'license' 	  => $xml->license,
		));		
		
		$file1 = APPLICATION_PATH .'\modules\\'. $module .'\install\ModuleUser.sql';
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