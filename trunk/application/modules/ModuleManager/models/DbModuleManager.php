<?php
class Model_DbModuleManager extends Zend_Db_Table_Abstract//lớp thao tác với table modulemanager
{
	protected $_name='modulemanager';
	public function getModules()
	{
		$sql  = "SELECT * FROM modulemanager ORDER BY name ASC";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
		//trả về Zend_Db_Statement
	}
	public function addmodule($data) 
	{
		//ID table modulemanager đã để tự động tăng nên không cần insert
		$sql = sprintf("INSERT INTO modulemanager (name, description, thumbnail, author, email, version, license)
						VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
						$data['name'],
						$data['description'],
						$data['thumbnail'],
						$data['author'],
						$data['email'],
						$data['version'],
						$data['license']);
		$db=$this->getDefaultAdapter();
		try {
			$db->query($sql)or die("Can not insert database "); 
		} catch (Exception $e) {
		}
		
	}
	public  function deletemodule($name)
	{
		$sql = sprintf("DELETE FROM modulemanager WHERE name = '%s'", 
						$name);
		$db=$this->getDefaultAdapter();
		try 
		{
			$db->query($sql)or die("Can not delete database "); 
		} 
		catch (Exception $e) {
		}
	}
	
}