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
		$file = APPLICATION_PATH .'\modules\\'. $name . '\config' .'\about.xml';
		if (!file_exists($file)) {
			return null;
		}
		$xml = simplexml_load_file($file);
		$moduleObj = new Admin_Model_ModuleEntity();
		$moduleObj->setEntity(array(
			'name' 		  => strtolower($xml->name),
			'description' => $xml->description,
			'thumbnail'   => $xml->thumbnail,
			'author' 	  => $xml->author,
			'email' 	  => $xml->email,
			'version' 	  => $xml->version,
			'license' 	  => $xml->license,
		));
		$file1 = APPLICATION_PATH .'\modules\\'. $name .'\install\install.sql';
		//$fp=fopen($file1,"r"); 
		//$contents = fread ($fp, filesize($file1)); 
		//fclose($fp);
	
		$request = $this->getRequest();
		$url= $request->getScheme() . '://' . $request->getHttpHost();
		$client = new Zend_Rest_Client($url);
		$rst= explode("$$", $contents);
		$mang=explode(",", $row);
		$option['method']='install';
		$option['file']=$file1;
		echo $file1;
		$client->Restget('/RestServer/index.php/admin/module/talk',$option)->getBody();	


		$option1['method']='insert';
		$option1['name']=(string)$moduleObj->data['name'];
		$option1['description']=(string)$moduleObj->data['description'];
		$option1['thumbnail']=(string)$moduleObj->data['thumbnail'];
		$option1['author']=(string)$moduleObj->data['author'];
		$option1['email']=(string)$moduleObj->data['email'];
		$option1['version']=(string)$moduleObj->data['version'];
		$option1['license']=(string)$moduleObj->data['license'];
		$client->Restget('/RestServer/index.php/admin/module/talk',$option1)->getBody();

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
		$request = $this->getRequest();
		$url= $request->getScheme() . '://' . $request->getHttpHost();
		$client = new Zend_Rest_Client($url);
		$option['method']='getAllRows';
		$result = $client->Restget('/RestServer/index.php/admin/module/talk',$option)->getBody();
		$xml = simplexml_load_string($result);
		//print_r($xml);
		$dbModules = array();
		$counter=count($xml->module_id);
		for($i=0; $i < $counter ;$i+=1)
		{
			$key= (string)$xml->name[$i];
			$dbModules[$key]=(string)$xml->module_id[$i];
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
		
		$request = $this->getRequest();
		$url= $request->getScheme() . '://' . $request->getHttpHost();
		$client = new Zend_Rest_Client($url);
		$option['method']='delete';
		$option['name']=$name;
		$client->Restget('/RestServer/index.php/admin/module/talk',$option)->getBody();	
		
		$file1 = APPLICATION_PATH .'\modules\\'. $name .'\uninstall\uninstall.sql';
		$client = new Zend_Rest_Client($url);
		$option1['method']='uninstall';
		$option1['file']=$file1;
		$client->Restget('/RestServer/index.php/admin/module/talk',$option1)->getBody();
		
		$this->_redirect('/admin/module/list');
	}
}


