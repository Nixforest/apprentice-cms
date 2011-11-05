<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Define some variable
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

define('APPRENTICE_ROOT_DIR', dirname(__FILE__));
define('APPRENTICE_APP_DIR',  APPRENTICE_ROOT_DIR . DS . 'application');
define('APPRENTICE_LIB_DIR',  APPRENTICE_ROOT_DIR . DS . 'libraries');
define('APPRENTICE_TEMP_DIR', APPRENTICE_ROOT_DIR . DS . 'temp');


// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));
define('URL_IMG','../public/images');
define('URL_CSS','../public/css');
/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();
