<?php
class Category_IndexController extends Zend_Controller_Action{
	public function indexAction(){
		include '../application/modules/category/forms/CategoryForm.php';	
		$this->_redirect('category/admin/list');	
	}
}