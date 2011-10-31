<?php
class News_Bootstrap extends Zend_Application_Module_Bootstrap
{
        public function _initAutoload()
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
                    return $autoLoader;
        }
}