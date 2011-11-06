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
	
	public function init(){
		// khi ấn 1 nút chọn template sẽ truyền đường dẫn và load template đó sử dụng. 
		//đồng thời ghi đường dẫn template đó vào application.ini cái này có thể chạy nhưng sẽ thay đổi lại file application
      
		// upload 1 template	
	
			
		}
		
	    // load những file view của các controller vào 1 vị trí trên template bất kỳ

		
		// ghi vào application.ini edit lại đường dẫn layout cho toàn chương trình
		/*$dirApp= APPLICATION_PATH . DS. 'configs/application.ini';
      	$section = 'production';
      	$options = array('allowModifications'=>true,'skipExtends'=> true);
      	//load application.ini voi 3 tham số.
      	$config = new Zend_Config_Ini($dirApp,$section,$options);
      	//chỉnh sửa bên trong
      	$config->resources->layout->layoutPath=$dirLayout;
      	// ghi cung cấp 2 tham số: đường dẫn và file ghi
      	$writer = new Zend_Config_Writer_Ini(array('config'=> $config,'filename' => $dirApp));
      	$writer->write();*/
      		
/*  	cùng code
		$config = new Zend_Config_Ini($dirApp, 'production', array('allowModifications' => true));
		$config->production->resources->layout->layoutPath=$dirLayout;
		$writer = new Zend_Config_Writer_Ini();
		$writer->write($dirApp, $config);*/
     
	
		
	
	public function indexAction(){
	
	}
	

	
	/**
	 * List templates
	 * 
	 * @return void
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
	

	
	public function listAction() 
	{
		$post = $this->getRequest();
		// cái này sẽ để trong activeAction() sau này
		if($post->ispost()){
			
			if($post->getPost("btnChon")){
				$dirName=$post->getPost("btnChon");

				// Chỉ ra đường dẫn đến thư mục chứa các file template
			    $dirLayout = APPLICATION_PATH."/template/".$dirName;

			    // Dùng thư viện Zend_Layout để gọi layout.
			    $option= array(
			                'layoutPath' => $dirLayout,
			                'layout' => 'index'
			                );
			    Zend_Layout::startMvc($option);
			}
		}
		
		$temp = new Zend_Config_Ini('../application/configs/application.ini','production');
		
		$dirTemp = $temp->toArray();
	
		$subDirs = self::getSubDir(APPLICATION_PATH . '\template\\');
		
		$templates = array();

			/**
			 * Load template info
			 */

		foreach ($subDirs as $dir){
		
			
			$file  = APPLICATION_PATH .'\template\\'. $dir .'\about.xml';
			if (!file_exists($file)) {
				continue;
			}
			
			$xml = simplexml_load_file($file);
			//if ((string)$xml->selectable == 'false') {
			//	continue;
			//}
			
			$template = array(
				'name' 		  => strtolower($xml->name),
				'description' => (string)$xml->description,
				'thumbnail'   => (string)$xml->thumbnail,
				'author' 	  => (string)$xml->author,
				'email' 	  => (string)$xml->email,
				'version' 	  => (string)$xml->version,
				'license' 	  => (string)$xml->license
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
			$templates[]=$template;

		
		
		//$this->view->assign('currTemplate', $dirTemp->production['template']);
		//$this->view->assign('currSkin', $dirTemp->production['skin']);
		$this->view->assign('templates',$templates);
		

	}
	
}
	
}
