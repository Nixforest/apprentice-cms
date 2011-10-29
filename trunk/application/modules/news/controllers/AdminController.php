<?php
class News_AdminController extends Zend_Controller_Action{


	public function indexAction()
	{
		
	}
	
	public  function init()
	{
		$autoLoader = Zend_Loader_Autoloader::getInstance(); 
		    $autoLoader->registerNamespace('CMS_'); 
		    $resourceLoader = new Zend_Loader_Autoloader_Resource(array( 
		        'basePath'      => APPLICATION_PATH . '/modules/news', 
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
		    // Return it so that it can be stored by the bootstrap 
		    return $autoLoader; 
	}
	
	public function addAction()
	{
		$article = new Model_ArticleDTO();
		$article->set('title', 'Tieu De E');
		$article->set('author', 'Nguyen Van E');
		$article->set('article_id', 79);
		
		$newsBlo = new Model_NewsBLO();
		$newsBlo->updateNews($article);
		//$newsBlo->deleteNews(79);
		
		$this->view->result =  "Ban Vua them vao bai viet co so id la ";
		
	}

	//DUONG THAN DAN
	public function listAction(){
		//$module = new Model_News();
		$module = new Model_NewsBLO();
		$result=$module->getAll();
		$this->view->result=$result;
	}
	
	public function editAction(){
		include '../application/modules/news/forms/editForm.php';
		$form = new Form_Edit();
		//$form->setAction('../News/edit/');
		$form->setMethod('post');
		
		if($this->getRequest()->isPost()){
			if($form->isValid($_POST)){
				$article = new Model_ArticleDTO();
				$article->set('article_id', $form->getValue('article_id'));
				$article->set('title', $form->getValue('title'));
				$article->set('description', $form->getValue('description'));
				
				$newsBlo = new Model_NewsBLO();
				$newsBlo->updateNews($article);
				
				$this->_redirect('news/admin/list');
			}
		}
		else{
			$article_id = $this->_request->getParam('id');
			
			$module = new Model_NewsBLO();
			$newsEdit = $module->getById($article_id);
			
			$newsEdit->setFetchMode(Zend_Db::FETCH_NUM);
			if($row = $newsEdit->fetchAll()){
				$form->title->setValue($row[0][1]);
				$form->description->setValue($row[0][2]);
				$form->article_id->setValue($row[0][0]);		
			}
		}
		
		$this->view->form = $form;
	}
	
	public function deleteAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_NewsBLO();
		$module->deleteNews($article_id);
		
		$this->_redirect('news/admin/list');
	}
	
	public function activeAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_NewsBLO();
		$module->changeStatus($article_id, 'active');
		
		$this->_redirect('news/admin/list');
	}
	
	public function deactiveAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_NewsBLO();
		$module->changeStatus($article_id, 'inactive');
		
		$this->_redirect('news/admin/list');
	}
	
}