<?php
class Admin_Model_ModuleBAO{
	
	// Get all rows
	public function getAllRows()
	{
		$module= new Admin_Model_ModuleDAO();
		return $module->getAllRows();
	}
	
	// Insert
	public function insert($data) 
	{
		$module= new Admin_Model_ModuleDAO();
		$module->insert($data);
	}
	
	// Delete
	public function delete($name)
	{
		$module = new Admin_Model_ModuleDAO();
		$module->delete($name);
	}
	
	// Install a module
    public function install($module)
	{
		$file = APPLICATION_PATH .'\modules\\'. $module . '\config' .'\about.xml';
		if (!file_exists($file)) {
			return null;
		}
		$xml = simplexml_load_file($file);
		$moduleObj = new Admin_Model_ModuleEntity();
		$moduleObj->setEntity(array(
			'name' 		  => strtolower($xml->name),
			'description' => $xml->description,
			'thumbnail'   => $xml->thumbnail,
			'author' 	  => $xml->author,
			'email' 	  => $xml->email,
			'version' 	  => $xml->version,
			'license' 	  => $xml->license,
		));
		
		
		$file1 = APPLICATION_PATH .'\modules\\'. $module .'\install\install.sql';
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
		return  $moduleObj;	
	}
	
	// Uninstall a module
	public function uninstall($module)
	{
		$this->delete($module);		
		
		$file1 = APPLICATION_PATH .'\modules\\'. $module .'\uninstall\uninstall.sql';
		$fp=fopen($file1,"r"); 
		$contents = fread($fp, filesize($file1)); 
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
	}
}