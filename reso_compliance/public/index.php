<?php
error_reporting(E_ALL);
    defined('ROOT_PATH')
        || define('ROOT_PATH', realpath(dirname(__FILE__)));
    // Define path to application directory
    defined('APPLICATION_PATH')
        || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

    // Define application environment
    defined('APPLICATION_ENV')
        || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

    // Ensure library/ is on include_path
    set_include_path(implode(PATH_SEPARATOR, array(
        realpath(APPLICATION_PATH . '/../library'),
        get_include_path(),
    )));
    define('INI_PATH', '/configs/application.ini');

    /** Zend_Application */
    require_once 'Zend/Application.php';
    require_once 'Zend/Registry.php';
    require_once(APPLICATION_PATH."/common/Common.php"); 
    $registry = new Zend_Registry(array('index' => $value));
    Zend_Registry::setInstance($registry);
    // Create application, bootstrap, and run
    $application = new Zend_Application(
        APPLICATION_ENV,
        APPLICATION_PATH . INI_PATH
    );
    $application->bootstrap()
                ->run();
?>