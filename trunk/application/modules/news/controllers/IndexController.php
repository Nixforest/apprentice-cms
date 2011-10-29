<?php
class News_IndexController extends Zend_Controller_Action{


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
		
		$newsBlo = new Model_NewsBLO();
		$rows= $newsBlo->getAll();
		echo $rows[0]['title'];	
		//$this->view->result =  "Ban Vua them vao bai viet co so id la $id[0]->title ";
		
	}
	
	
}