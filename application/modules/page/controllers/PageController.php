<?php
class Page_PageController extends Zend_Controller_Action {
	public function addAction(){
		
	}
	
	public function listAction(){
		$module = new Model_PageDAO();
		$result=$module->getAll();
		$this->view->result=$result;		
		
		
		$request = $this->getRequest();
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
	}
	
	public function newAction() {
		
		$request = $this->getRequest();
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
	}

	public function editAction() {
		
		$request = $this->getRequest();
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
	}
	

	public function deleteAction() {
		
	}
}

?>