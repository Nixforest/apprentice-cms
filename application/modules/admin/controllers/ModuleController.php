<?php
/**
 * Apprentice CMS
 */

class Admin_ModuleController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */
	/**
	 * Initializing autoloader models class
	 * 
	 * @return void
	 */
	

	
	/**
	 * Install module
	 * 
	 * @return void
	 */
	public function installAction() 
	{
		$name = $this->_request->getParam('name');
			$db = new Admin_Model_ModuleBAO();
			$db->insert($db->install($name)->data);
			$this->_redirect('/admin/module/list'); 
		
	}
	
	/**
	 * Get sub directory
	 * 
	 * @return sub directory
	 */
	public static function getSubDir($dir) 
	{
		if (!file_exists($dir)) {
			return array();
		}
		
		$subDirs 	 = array();
		$dirIterator = new DirectoryIterator($dir);
		foreach ($dirIterator as $dir) {
            if ($dir->isDot() || !$dir->isDir()) {
                continue;
            }
            $dir = $dir->getFilename();
            if ($dir == '.svn') {
            	continue;
            }
            $subDirs[] = $dir;
		}
		return $subDirs;
	}
	
	/**
	 * List modules
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		// Handle Upload button submit
		if(isset($_POST['btnsubmit'])){
			if($_FILES['file']!=null){				
				move_uploaded_file($_FILES['file']['tmp_name'], APPLICATION_PATH."/modules/".$_FILES['file']['name']);
				
				// Unzip file upload
				$filter     = new Zend_Filter_Decompress(array('adapter' => 'Zip','options' => array('target' => APPLICATION_PATH.'/modules',)));
				$testUncompressed = $filter->filter(APPLICATION_PATH.'/modules/'.$_FILES['file']['name']);
				if ($testUncompressed)
				{
					unlink(APPLICATION_PATH.'/modules/'.$_FILES['file']['name']);
				}
				else 
				{
					$this->view->ErrorMessage=true;
				}						
				
			}
		}
		
		// Create list modules in folder 'modules'
		$modules = array();
		$i = 0;
		
		$subdir = self::getSubDir(APPLICATION_PATH .'\modules\\');
		foreach ($subdir as $dir) {
			if ($dir == 'admin')
				continue;
			$file = APPLICATION_PATH .'\modules\\'. $dir . '\config' .'\about.xml';
			if (file_exists($file)) {
				//return null;
			}
			$xml = simplexml_load_file($file);
			
			$info = array(
				'name' 		  => strtolower($xml->name),
				'description' => $xml->description,
				'thumbnail'   => $xml->thumbnail,
				'author' 	  => $xml->author,
				'email' 	  => $xml->email,
				'version' 	  => $xml->version,
				'license' 	  => $xml->license,
			);
			$modules[$i] = $info;
			$i++;
			
		}
		
		$this->view->modules = $modules;
		
		// Get the list of modules from database
		$dbModules = array();
		$db = new Admin_Model_ModuleBAO();
		$rs = $db->getAllRows();
		if ($rs){
			while ($row = $rs->fetch()){
				$key = $row['name'];
				$dbModules[$key] = $row['module_id'];
			} 
		}
		$this->view->assign('dbModules', $dbModules);
		
	}
	
	/**
	 * Uninstall module
	 * 
	 * @return void
	 */
	public function uninstallAction() 
	{
		$name = $this->_request->getParam('name');
			$db = new Admin_Model_ModuleBAO();
			$db->uninstall($name);
			$this->_redirect('/admin/module/list');
	}
}


