<?php
class Admin_Model_ModuleDAO extends Zend_Db_Table_Abstract{
	
	// modulemanager table
	protected $_name='admin_module';
	
	// Get all rows
	public function getAllRows()
	{
		$sql  = "SELECT * FROM admin_module ORDER BY name ASC";
		$db = $this->getDefaultAdapter();
		return $db->query($sql);
		//trả về Zend_Db_Statement
	}
	
	// Insert
	public function insert($data) 
	{
		//ID table admin_module đã để tự động tăng nên không cần insert
		$sql = sprintf("INSERT INTO admin_module (name, description, thumbnail, author, email, version, license)
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
		} catch (Exception $e) {}
		
	}
		
	// Delete
	public function delete($name)
	{
		$sql = sprintf("DELETE FROM admin_module WHERE name = '%s'", 
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