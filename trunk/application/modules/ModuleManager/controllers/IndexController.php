<?php
class ModuleManager_IndexController extends Zend_Controller_Action{
	public function indexAction(){
		
	}
	
	public function listAction(){		
		if(isset($_POST['btnsubmit'])){
			if($_FILES['file']!=null){				
				move_uploaded_file($_FILES['file']['tmp_name'], APPLICATION_PATH."/modules/".$_FILES['file']['name']);
				
				$filter = new Zend_Filter_Decompress(array(
					'adapter' => 'zip',
					'option' => array(
						'target' => 'C:\Temp')));
				/*$options = array(
				   'adapter' => 'zip',
				   'options' => array(
				            'target' => APPLICATION_PATH."/modules/",
				            ),
				      );
				$filter = new Zend_Filter_Decompress($options);*/
				
				$filter->filter(APPLICATION_PATH."/modules/".$_FILES['file']['name']);
				
				echo APPLICATION_PATH."/modules/".$_FILES['file']['name'];
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