<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
    public function _initAutoload()
    {
    }

    /**
     * 
     */
    protected function _initResourceLoader()
    {
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH,
        ));
        $resourceLoader->addResourceType('phrets', 'plugins/phrets/', 'Rets');
//        $resourceLoader->addResourceType('helper', 'plugins/helper/', 'Helper');
        return $resourceLoader;
    }
}

