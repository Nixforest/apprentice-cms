<?php
/**
 * Apprentice CMS
 */

class Admin_IndexController extends Zend_Controller_Action
{
	/* ========== Frontend actions ========================================== */
	
	/**
	 * Default action which will be dispatched when user browse to /
	 * From 2.0.7, we move the index controller from default controller directory
	 * (/application/controllers/) to core module.
	 * The "/" URL /
	 *  be mapped to core_index_index route, therefore user can 
	 * configure the layout of index route in back-end section.
	 * 
	 * @return void
	 */
	
	/*
	 * Công 
	 * Zend_Navigation
	 */
	private $_acl=null;
	
	public function indexAction()
	{
		$auth=Zend_Auth::getInstance();
		if(!$auth->hasIdentity())
		{
			//process the data
	        $this->_redirector = $this->_helper->getHelper('Redirector');
			$this->_redirector->gotoUrl('../public/index');
		}
		else
		{
			$userdata=$auth->getIdentity();
			$this->user_name=$userdata->user_name;
			$this->user_role=$userdata->role_id;
			$this->_acl=new ResAcl();
			
			$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

			$container = new Zend_Navigation($config);
		
			$this->view->navigation($container)->setAcl($this->_acl)->setRole($this->user_role);
		}
	}
}
