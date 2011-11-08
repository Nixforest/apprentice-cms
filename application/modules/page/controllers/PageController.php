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
		if ($request->isPost()) {
			$varTitle = strip_tags($request->getPost('txtName'));
			echo $varTitle;
			$page = new Model_PageDTO();
			$page->setData(array(
				'name'		=> $varTitle,
				'description'		=> $request->getPost('description'),
				'content'		=> $request->getPost('content'),
				'parent_id'		=> 0,
				'num_views'		=> 0,
				'create_date'		=> date('Y-m-d H:i:s'),
				'modified_date'		=> date('Y-m-d H:i:s'),
				'user_id'		=> 'null',
				'language'		=> $request->getPost('txtLang')
			));
			$page_dao = new Model_PageDAO();
			$page_dao->addPage($page);			
			
			$this->_redirect('page/page/list');
		}
		
		
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
	}

	public function editAction() {
		$request = $this->getRequest();
        $url = $request->getScheme() . '://' . $request->getHttpHost().'/Apprentice_CMS/';
        $this->view->url = $url;
        
		$page_id = $this->_request->getParam('id');
		
		if($this->getRequest()->isPost()){
			$page = new Model_PageDTO();
			$page->setData(array(
				'page_id'			=> $page_id,
				'name'		=> strip_tags($request->getPost('txtName')),
				'description'		=> $request->getPost('description'),
				'content'		=> $request->getPost('content'),
				'parent_id'		=> 0,
				'num_views'		=> 0,
				'create_date'		=> date('Y-m-d H:i:s'),
				'modified_date'		=> date('Y-m-d H:i:s'),
				'user_id'		=> 'null',
				'language'		=> $request->getPost('txtLang')
			));
			
			$module = new Model_PageDAO();
			$module->updatePage($page);
			
			$this->_redirect('page/page/list');
		}
		else{
			$module = new Model_PageDAO();
			$pageEdit = $module->getById($page_id);
			
			$pageEdit->setFetchMode(Zend_Db::FETCH_NUM);
			if($row = $pageEdit->fetchAll()){
				$this->view->pageTitle = $row[0][1];
				$this->view->pageDescription = $row[0][2];
				$this->view->pageContent = $row[0][3];
				$this->view->pageLang = $row[0][9];
			}
		}
	}
	

	public function deleteAction() {
		$page_id = $this->_request->getParam('id');
		
		$module = new Model_PageDAO();
		$module->deletePage($page_id);
		
		$this->_redirect('page/page/list');
	}
}

?>