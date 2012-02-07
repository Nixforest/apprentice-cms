<?php
require_once 'acl/acl.php';
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
	
	/*Công
	 * Khởi tạo view layout
	 */
	protected function _initView(){
		$this->bootstrap('layout');
		$layout=$this->getResource('layout');
		Zend_Registry::set('layout', $layout);
	}
	
	/* Cong
	 * Navigation
	 */
	/*private $_acl=null;
	protected $_redirector=null;
	
	protected function _initNavigation()
	{
		$auth=Zend_Auth::getInstance();
		if(!$auth->hasIdentity())
		{
			echo 'Please login.';
			//$this->_redirector=Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
			//$this->_redirector->gotoUrl('/Apprentice_CMS/public/admin/auth/login');
		}
		else
		{
			$userdata=$auth->getIdentity();
			$this->user_name=$userdata->user_name;
			$this->user_role=$userdata->role_id;
			$this->_acl=new ResAcl();
			$this->bootstrap('layout');
        	$layout = $this->getResource('layout');
        	$view = $layout->getView();		
        	$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

			$container = new Zend_Navigation($config);
		
			$view->navigation($container)->setAcl($this->_acl)->setRole($this->user_role);
		}
	}*/
	
	/*
	protected function _initAutoload()
	{
		//Add autoloader empty namespace
		$autoLoader=Zend_Loader_Autoloader::getInstance();
		$resourceLoader=new Zend_Loader_Autoloader_Resource(array(
							'basePath'=>APPLICATION_PATH,
							'namespace'=>'',
							'resourceTypes'=>array(
													'form'=>array(
															'path'=>'forms/','namespace'=>'Form_')
												)
							));
		//Return it so that  it can be stored by the bootstrap
		return $autoLoader;
	}
	*/

}

