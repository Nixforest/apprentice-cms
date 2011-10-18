<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
		protected function _initDb(){
		
		$optionResources = $this->getOption('resources');
		$dbOption = $optionResources['db'];
		$dbOption['params']['username'] = 'apprentice';
		$dbOption['params']['password'] = 'apprentice';
		$dbOption['params']['dbname'] = 'apprentice_cms';
		
		$adapter = $dbOption['adapter'];
		$config = $dbOption['params'];
		
		$db = Zend_Db::factory($adapter,$config);
		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
		$db->query("SET NAMES 'utf8'");
		$db->query("SET CHARACTER SET 'utf8'");
		
		Zend_Registry::set('connectDb',$db);
		Zend_Db_Table::setDefaultAdapter($db);
		
		return $db;
		
	}

}

