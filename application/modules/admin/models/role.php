<?php
class Model_Role extends Zend_Db_Table_Abstract
{
	//ket noi voi csdl
	public static function conn(){
		$connParams=array(	'host' => 'localhost',
							'username'	=>	'apprentice',
							'password'	=>	'apprentice',
							'dbname'	=>	'apprentice_cms');
		$db=new Zend_Db_Adapter_Pdo_Mysql($connParams);
		return $db;
	}	
    
}