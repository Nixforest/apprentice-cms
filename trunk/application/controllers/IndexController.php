<?php
//require_once '../application/models/Models.php';
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        /* Initialize action controller here */
    	//$base = $this->_request->getBaseUrl();
       	//$this->view->headScript()->appendFile("../application/models/jquery-1.6.js");
        //$this->view->headScript()->appendFile("../application/models/Menu.js");
        //$this->view->headLink()->appendStylesheet('../application/models/Menu.css');
    	//$base = $this->_request->getBaseUrl();
       	//$this->view->headScript()->appendFile($base."/js/jquery-1.6.js");
        //$this->view->headScript()->appendFile($base."/js/Menu.js");
        //$this->view->headLink()->appendStylesheet($base.'/css/Menu.css'); 
    }

    public function indexAction()
    {
        // action body
        //$menuBLO = new Model_MenuBLO();
		//$menus = $menuBLO->getMenus();
		//$items = $menuBLO->getItems('2');
		//$this->view->listMenuItem = $items;
    }


}

