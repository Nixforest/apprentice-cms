<?php
class ModuleManager_IndexController extends Zend_Controller_Action{
	public function indexAction(){
		
	}
	
	public function listAction(){
		$query = "select * from modulemanager;";
		$db = Zend_Registry::get('connectDb');
		$result = $db->query($query);
		$this->view->result=$result;
	}
}