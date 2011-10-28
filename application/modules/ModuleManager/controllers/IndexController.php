<?php
class ModuleManager_IndexController extends Zend_Controller_Action{
	public function indexAction(){
		
		$module= new Model_BsModuleManager();
		//khởi tạo đối tượng module 
		$mod = new Model_ModuleManagerEntity();
		$mod->set('name','ModuleTest');
		$mod->set('description','Test');
		$mod->set('thumbnail','');
		$mod->set('author','DangVu');
		$mod->set('email','dangvu3001@gmail.com');
		$mod->set('version','1.0');
		$mod->set('license','trial');
		$module->addmodule($mod->data); //insert vào cơ sở dữ liệu
		
		
		$result =$module->getdata();//Load các record trong table modulemanager
		$this->view->result=$result;
		
		//gọi phương thức delete cần truyền tên module vào
		$module->deletemodule('ModuleTest');//Xóa record theo tên truyền vào.
		
	}
	public  function installAction()//hàm chạy phần install
	{	
		//gọi phương thức instal cần truyền tên module vào.	
		$settup = new Model_BsModuleManager();
		$settup->install('ModuleManager');
	}
	
	
	public function listAction(){		
		if(isset($_POST['btnsubmit'])){
			if($_FILES['file']!=null){				
				move_uploaded_file($_FILES['file']['tmp_name'], APPLICATION_PATH."/modules/".$_FILES['file']['name']);
				/*
				$filter = new Zend_Filter_Decompress(array(
					'adapter' => 'zip',
					'option' => array(
						'target' => APPLICATION_PATH.'/modules'),));
				*/
				//$filter->filter(APPLICATION_PATH."/modules/".$_FILES['file']['name']);
				
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
				$query1 = "insert into modulemanager (module_id,name,description,thumbnail,author, email,version,license) values('3','contact','Contact module', '','Nixforest', 'Nixforest21991920@gmail.com','1.0.0','free')";
				$db = Zend_Registry::get('connectDb');
				$result = $db->query($query1);
			}
		}
		$query = "select * from modulemanager;";
		$db = Zend_Registry::get('connectDb');
		$result = $db->query($query);
		$this->view->result=$result;	
	}
		
}