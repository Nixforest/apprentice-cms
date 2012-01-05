<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap{
	public function _initAutoload(){
		$autoLoader = Zend_Loader_Autoloader::getInstance(); 
		    $autoLoader->registerNamespace('CMS_'); 
		    $resourceLoader = new Zend_Loader_Autoloader_Resource(array( 
		        'basePath'      => APPLICATION_PATH . '/modules/admin', 
		        'namespace'     => '', 
		        'resourceTypes' => array( 
		            'form' => array( 
		                'path'      => 'forms/', 
		                'namespace' => 'Form_', 
		            ), 
		            'model' => array( 
		                'path'      => 'models/', 
		                'namespace' => 'Admin_Model_' 
		            ),
		             
		        ), 
		    )); 
		    return $autoLoader; 
	}
	
	/*
	 * Công
	 */
	
	private $_acl=null;
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
			$layout = Zend_Registry::get('layout');
        	$view = $layout->getView();		
        	$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

			$container = new Zend_Navigation($config);
			
			$view->navigation($container)->setAcl($this->_acl)->setRole($this->user_role);
		}
	}
}