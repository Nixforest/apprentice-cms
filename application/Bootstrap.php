<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{
		// Add autoloader empty namespace 
		    $autoLoader = Zend_Loader_Autoloader::getInstance(); 
		    $autoLoader->registerNamespace('CMS_'); 
		    $resourceLoader = new Zend_Loader_Autoloader_Resource(array( 
		        'basePath'      => APPLICATION_PATH, 
		        'namespace'     => '', 
		        'resourceTypes' => array( 
		            'form' => array( 
		                'path'      => 'forms/', 
		                'namespace' => 'Form_', 
		            ), 
		            'model' => array( 
		                'path'      => 'models/', 
		                'namespace' => 'Model_' 
		            ), 
		        ), 
		    )); 
		    // Return it so that it can be stored by the bootstrap 
		    return $autoLoader; 
	}
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

