<?php
/*Apprentice_CMS
 * */
/**
 * Enter description here ...
 * @author ThanhTrieu
 *
 */
class Admin_TemplateController extends Zend_Controller_Action{
	/* ========== Backend actions =========================================== */

	/**
	 * Activate template
	 * 
	 * @return void
	 */
	
	public function indexAction(){
		
		
	}
	
	public function activateAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$template = $request->getPost('template');
			
			$conn = Tomato_Db_Connection::factory()->getMasterConnection();
			$templateDao = Tomato_Model_Dao_Factory::getInstance()->setModule('core')->getTemplateDao();
			$templateDao->setDbConnection($conn);
			
			/**
			 * Update config file
			 *//*
			$file 	= TOMATO_APP_DIR . DS . 'config' . DS . 'application.ini';
			$config = new Zend_Config_Ini($file, null, array('allowModifications' => true));
			$config->web->template = $template;
			$writer = new Zend_Config_Writer_Ini();
			$writer->write($file, $config);
			*/
			/**
			 * Create template pages
			 */
			$templateDao->install($template);
			
			$this->getResponse()->setBody('RESULT_OK');
		}
	}
	
	/**
	 * Edit skin of template
	 * 
	 * @return void
	 *//*
	public function editskinAction() 
	{
		$request  = $this->getRequest();
		$template = $request->getParam('template');
		$skin 	  = $request->getParam('skin');
		
		$file = TOMATO_ROOT_DIR . DS . 'skins' . DS . $template . DS . $skin . DS . 'default.css';
		if (!$request->isPost()) {
			$content = file_get_contents($file);
			$this->view->assign('content', $content); 
		} else {
			$content = $request->getPost('content');
			@file_put_contents($file, $content);
			
			$this->_redirect($this->view->serverUrl() . $this->view->url(array('template' => $template, 'skin' => $skin), 'core_template_editskin'));
		}
		
		$this->view->assign('template', $template);
		$this->view->assign('skin', $skin);
	}
	*/
	/**
	 * List templates
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		/*
		$config = Tomato_Config::getConfig();
		
		$subDirs = Tomato_Utility_File::getSubDir(TOMATO_APP_DIR . DS . 'templates');
		$templates = array();
		foreach ($subDirs as $dir) {
			/**
			 * Load template info
			 *//*
			$file = TOMATO_APP_DIR . DS . 'templates' . DS . $dir . DS . 'about.xml';
			if (!file_exists($file)) {
				continue;
			}
			$xml = simplexml_load_file($file);
			if ((string)$xml->selectable == 'false') {
				continue;
			}
			$template = array(
				'name' 		  => strtolower($xml->name),
				'description' => (string)$xml->description,
				'thumbnail'   => (string)$xml->thumbnail,
				'author' 	  => (string)$xml->author,
				'email' 	  => (string)$xml->email,
				'version' 	  => (string)$xml->version,
				'license' 	  => (string)$xml->license,
			);
			$template['skin'] = array();
			foreach ($xml->skins->skin as $skin) {
				$attrs = $skin->attributes();
				$template['skin'][] = array(
					'name' 		  => (string)$attrs['name'],
					'color' 	  => (string)$skin->color,
					'description' => (string)$skin->description,
				);
			}
			
			$templates[] = $template;
		}
		*/
		$this->view->assign('currTemplate', $config->web->template);
		$this->view->assign('currSkin', $config->web->skin);
		$this->view->assign('templates', $templates);
	}
	
	/**
	 * Activate skin
	 * 
	 * @return void
	 */
	/*
	public function skinAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			/**
			 * Update config file
			 *//*
			$skin 	= $request->getPost('skin');
			$file 	= TOMATO_APP_DIR . DS . 'config' . DS . 'application.ini';
			$config = new Zend_Config_Ini($file, null, array('allowModifications' => true));
			$config->web->skin = $skin;
			
			/**
			 * Remove skin from cookie
			 *//*
			if (isset($_COOKIE['APP_SKIN'])) {
				unset($_COOKIE['APP_SKIN']);
			}
			
			$writer = new Zend_Config_Writer_Ini();
			$writer->write($file, $config);
			
			$this->getResponse()->setBody('RESULT_OK');
		}
	}
	*/
}
