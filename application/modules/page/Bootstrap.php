<?php
class Page_Bootstrap extends Zend_Application_Module_Bootstrap
{
        public function _initAutoload()
        {
                $autoLoader = Zend_Loader_Autoloader::getInstance(); 
                    $autoLoader->registerNamespace('CMS_'); 
                    $resourceLoader = new Zend_Loader_Autoloader_Resource(array( 
                        'basePath'      => APPLICATION_PATH . '/modules/page', 
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
        /*
	public function _initRoutes() {
		$front = Zend_Controller_Front::getInstance();
 
		// Get Router
		$router = $front->getRouter();
	 
		$route = new Zend_Controller_Router_Route(
	    	'page/page/view/:article_id',
	    	array(
	    		'module'     => 'page',
	        	'controller' => 'article',
	    		'action'     => 'view'
	    	)
		);
 		
		$router->addRoute('news_article_view', $route);
	}*/
}