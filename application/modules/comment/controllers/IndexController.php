<?php
class Comment_IndexController extends Zend_Controller_Action{
	public function indexAction(){
		include '../application/modules/comment/forms/CommentForm.php';	
		$this->_redirect('comment/admin/list');	
		//return $this->_forward('list','admin');
	}		
}