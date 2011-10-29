<?php
class Admin_NewsController extends Zend_Controller_Action
{
	public function indexAction() {
		
	}
	
	public function listAction(){
		$module = new Model_News();
		$result=$module->getAll();
		$this->view->result=$result;
	}
	
	public  function init()//khởi tạo load class ở thư mục models
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
		    // Return it so that it can be stored by the bootstrap 
		    return $autoLoader; 
	}
	
	public function editAction(){
		include '../application/modules/admin/forms/editForm.php';
		$form = new Form_Edit();
		//$form->setAction('../News/edit/');
		$form->setMethod('post');
		
	if($this->getRequest()->isPost()){
			if($form->isValid($_POST)){
				
				$module = new Model_News();
				$module->updateNews(
					$form->getValue('article_id'),
					$form->getValue('title'),
					$form->getValue('description'));
					
				$this->_redirect('admin/news/list');
			}
		}
		else{
			$article_id = $this->_request->getParam('id');
			
			$module = new Model_News();
			$newsEdit = $module->getOne($article_id);
			
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
		
		$module = new Model_News();
		$module->deleteNews($article_id);
		
		$this->_redirect('admin/news/list');
	}
	
	public function activeAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_News();
		$module->activeNews($article_id);
		
		$this->_redirect('admin/news/list');
	}
	
	public function deactiveAction(){
		$article_id = $this->_request->getParam('id');
		
		$module = new Model_News();
		$module->deactiveNews($article_id);
		
		$this->_redirect('admin/news/list');
	}
} 