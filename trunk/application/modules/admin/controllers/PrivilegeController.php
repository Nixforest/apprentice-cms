<?php
Class Admin_PrivilegeController extends Zend_Controller_Action{
	
	public  function init()
	{
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
                'namespace' => 'Model_' 
            ),              
        ), 
    ));
    return $autoLoader; 
	}
	
	public function listAction(){
			
		$conArray =null;			
		$db = new Model_Privilege();	

		//Danh sach cac module:
		$moduleResult = $db->getModuleName();
		$this->view->moduleResult = $moduleResult;	
	
		//Su kien click vao ten module
		//Hien thi danh sach cac quyen co trong module da click
		if(isset($_GET['modulename'])){
			$moduleName = (string)$_GET['modulename'];
			$priResult = $db->getAllPrivilege($moduleName);
			$this->view->priResult = $priResult;
			
			//Luu cac ten controller o trong module vao mang:
			$conResult = $db->getControllerName($moduleName);
			while($row = $conResult->fetch()){
				$conArray[]=$row['controller_name'];
			}
			$this->view->conArray = $conArray;
		}
		if($this->getRequest()->isPost()){
			$this->_redirect('admin');
		}
	}
	
	public function deleteAction() {	
		$db = new Model_Privilege();			
		//Su kien click vao nut Delete de xoa 1 quyen:		
		if($_GET['action'] ==="delete"){
			$id = $_GET['id'];	
			$module = (string)$_GET['module'];
			$db->deletePrivilege($id);
			$this->_redirect('admin/privilege/list?modulename='.$module);
		}
	}
	
	public function addAction() {
		
		$db = new Model_Privilege();		
		//Su kien click vao nut Add de them 1 quyen:				
		if($_GET['action'] === "add"){
			$id = $_GET['id'];	
			$module = (string)$_GET['module'];
			$db->addPrivilege($id);
			
			
			$this->_redirect('admin/privilege/list?modulename='.$module);			
		}
	}
}