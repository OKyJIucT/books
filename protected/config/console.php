<?php

$db_local = dirname(__FILE__) . '/db-local.php';

return CMap::mergeArray(
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'My Console Application',
        // preloading 'log' component
        'preload' => array('log'),
        'import' => array(
            'application.models.*',
            'application.components.*',
            'ext.YiiMailer.*',
        ),
        // application components
        'components' => array(
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                ),
            ),
        ),
    ),
    file_exists($db_local) ? require $db_local : array()
);