<?php
/**
 * Apprentice CMS
 */

class Admin_ModuleController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */
	
	/**
	 * Install module
	 * 
	 * @return void
	 */
	public function installAction() 
	{
	}
	
	/**
	 * List modules
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		/*$modules = array();
		$subDirs = Tomato_Utility_File::getSubDir(TOMATO_APP_DIR . DS . 'modules');
		foreach ($subDirs as $dir) {
			if ($dir == 'core') {
				continue;
			}
			$file = TOMATO_APP_DIR . DS . 'modules' . DS . $dir . DS . 'config' . DS . 'about.xml';
			if (!file_exists($file)) {
				continue;
			}
			$xml 	 = simplexml_load_file($file);
			$attr 	 = $xml->description->attributes();
			$langKey = (string) $attr['langKey'];
			$description = $this->view->translator($langKey, $dir);
			$description = ($description == $langKey) ? (string)$xml->description : $description;
			
			$info = array(
				'name' 		  => strtolower($xml->name),
				'description' => $description,
				'thumbnail'   => $xml->thumbnail,
				'author' 	  => $xml->author,
				'email' 	  => $xml->email,
				'version' 	  => $xml->version,
				'license' 	  => $xml->license,
			);
			$info['required'] = array(
				'modules' => array(),
				'libs' 	  => array(),
				'other'   => null,
			);
			if ($xml->requires) {
				if ($xml->requires->requiredModules) {
					foreach ($xml->requires->requiredModules->requiredModule as $mod) {
						$attrs = $mod->attributes();
						$info['required']['modules'][] = (string) $attrs['name'];
					}
				}
				if ($xml->requires->libs) {
					foreach ($xml->requires->libs->lib as $lib) {
						$info['required']['libs'][] = array(
							'type' 		  => $lib->type,
							'name' 		  => $lib->name,
							'link' 		  => $lib->link,
							'description' => $lib->description,
						);
					}
				}
				if ($xml->requires->other) {
					$info['required']['other'] = $xml->requires->other;
				}
			}
			$modules[] = $info;
		}*/
		
	if(isset($_POST['btnsubmit'])){
			if($_FILES['file']!=null){				
				move_uploaded_file($_FILES['file']['tmp_name'], APPLICATION_PATH."/modules/".$_FILES['file']['name']);
				
				/*$filter = new Zend_Filter_Decompress(array(
					'adapter' => 'zip',
					'option' => array(
						'target' => 'C:\Temp')));*/
				/*$options = array(
				   'adapter' => 'zip',
				   'options' => array(
				            'target' => APPLICATION_PATH."/modules/",
				            ),
				      );
				$filter = new Zend_Filter_Decompress($options);*/
				
				//$filter->filter(APPLICATION_PATH."/modules/".$_FILES['file']['name']);
				
				echo APPLICATION_PATH."/modules/".$_FILES['file']['name'];
				$query1 = "insert into modulemanager (module_id,name,description,thumbnail,author, email,version,license) values('3','contact','Contact module', '','Nixforest', 'Nixforest21991920@gmail.com','1.0.0','free')";
				$db = Zend_Registry::get('connectDb');
				$result = $db->query($query1);
			}
		}
		
		/**
		 * Get the list of modules from database
		 */
		
		$query = "select * from modulemanager;";
		$db = Zend_Registry::get('connectDb');
		$result = $db->query($query);
		$this->view->result=$result;
		/*
		$dbModules = array();
		$conn = Tomato_Db_Connection::factory()->getMasterConnection();
		$moduleDao = Tomato_Model_Dao_Factory::getInstance()->setModule('core')->getModuleDao();
		$moduleDao->setDbConnection($conn);
		$rs = $moduleDao->getModules();
		if ($rs) {
			foreach ($rs as $row) {
				$key = $row->name; 
				$dbModules[$key] = $key.':'.$row->module_id;
			}
		}
		
		$this->view->assign('modules', $modules);
		$this->view->assign('dbModules', $dbModules);*/
	}
	
	/**
	 * Uninstall module
	 * 
	 * @return void
	 */
	public function uninstallAction() 
	{/*
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$name = $request->getPost('name');
			$name = strtolower($name);
			if ($name == 'core') {
				$this->getResponse()->setBody('RESULT_ERROR');
			} else {
				$conn = Tomato_Db_Connection::factory()->getMasterConnection();
				$moduleDao = Tomato_Model_Dao_Factory::getInstance()->setModule('core')->getModuleDao();
				$moduleDao->setDbConnection($conn);
				$moduleDao->uninstall($name);
				
				$this->getResponse()->setBody('RESULT_OK');
			}
		}*/
	}
	
	/**
	 * Upload new module
	 * 
	 * @return void
	 */
	public function uploadAction() 
	{
		/*$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$file 	 = $_FILES['file'];
			$prefix  = 'module_' . time();
			$zipFile = TOMATO_TEMP_DIR . DS . $prefix . $file['name'];
			move_uploaded_file($file['tmp_name'], $zipFile);*/
			
			/**
			 * Process uploaded file
			 */
			/*$zip = Tomato_Zip::factory($zipFile);
			$res = $zip->open();
			if ($res === true) {
				$tempDir = TOMATO_TEMP_DIR . DS . $prefix;
				if (!file_exists($tempDir)) {
					mkdir($tempDir);
				}
				$zip->extract($tempDir);*/
				
				/**
				 * Get the first (and only) sub-forder
				 */
				/*$subDirs 	= Tomato_Utility_File::getSubDir($tempDir);
				$moduleName = $subDirs[0];*/
				
				/**
				 * Check if the module does exist or not
				 */ 
				//if (!file_exists(TOMATO_APP_DIR . DS . 'modules' . DS . $moduleName)) {
					/**
					 * Copy to the modules directory
					 */
					//Tomato_Utility_File::copyRescursiveDir($tempDir . DS . $moduleName, TOMATO_APP_DIR . DS . 'modules' . DS . $moduleName);
				//}
				
				/**
				 * Remove all the temp files
				 */
				/*$zip->close();
				
				Tomato_Utility_File::deleteRescursiveDir($tempDir);
				unlink($zipFile);
			}
			
			$this->_redirect($this->view->serverUrl() . $this->view->url(array(), 'core_module_list'));
		}*/
	}
}
