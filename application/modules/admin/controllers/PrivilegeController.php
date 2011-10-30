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
		$model = new Model_Privilege();	
		$db = Zend_Registry::get('connectDb');

		//Danh sach cac module:
		$moduleQuery = $model->getModuleName();
		$moduleResult = $db->query($moduleQuery);
		$this->view->moduleResult = $moduleResult;	
	
		//Su kien click vao ten module
		//Hien thi danh sach cac quyen co trong module da click
		if(isset($_GET['modulename'])){
			$moduleName = (string)$_GET['modulename'];
			$desQuery = $model->getDescription($moduleName);
			$desResult = $db->query($desQuery);
			$this->view->desResult = $desResult;
		}
	}
	
	public function deleteAction() {	
		$del = new Model_Privilege();		
		$db = Zend_Registry::get('connectDb');	
		//Su kien click vao nut Delete de xoa 1 quyen:		
		if($_GET['action'] ==="delete"){
			$id = $_GET['id'];	
			$module = (string)$_GET['module'];
			$query = $del->deletePrivilege($id);
			$db->query($query);
			//echo "<SCRIPT LANGUAGE='JavaScript'>
			//alert('Delete successfully')</script>";
			$this->_redirector = $this->_helper->getHelper('Redirector');
			$this->_redirector->gotoUrl('admin/privilege/list?modulename='.$module);
		}
	}
	
	public function addAction() {		
		$add = new Model_Privilege();		
		$db = Zend_Registry::get('connectDb');	
		//Su kien click vao nut Add de them 1 quyen:				
		if($_GET['action'] === "add"){
			$id = $_GET['id'];	
			$module = (string)$_GET['module'];
			$query = $add->addPrivilege($id);
			$db->query($query);
			//echo "<SCRIPT LANGUAGE='JavaScript'>
			//alert('Add successfully')</script>";
			$this->_redirector = $this->_helper->getHelper('Redirector');
			$this->_redirector->gotoUrl('admin/privilege/list?modulename='.$module);					
		}
	}
}