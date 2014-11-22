<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Сообщество переводчиков',
    'language' => 'ru',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.chapter.models.*',
        'application.modules.docs.models.*',
        'application.modules.parts.models.*',
        'application.modules.users.models.*',
        'ext.YiiMailer.*',
    ),
    'modules' => array(
        'rbac' => array(
            'class' => 'application.modules.rbacui.RbacuiModule',
            'userClass' => 'Users',
            'userIdColumn' => 'id',
            'userNameColumn' => 'username',
            'rbacUiAdmin' => true,
            'rbacUiAssign' => true,
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '5092503',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('91.200.183.133', '91.202.73.29', '91.202.73.30'),
        ),
        'chapter',
        'docs',
        'parts',
        'users',
    ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'cache' => array(
            'class' => 'CRedisCache',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 1,
            'behaviors' => array(
                'clear' => array(
                    'class' => 'application.components.TaggingBehavior',
                ),
            ),
        ),
        'file' => array(
            'class' => 'application.extensions.file.CFile',
        ),
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js' => false,
            ),
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'baseUrl' => 'http://walhall.ru',
            'rules' => array(
                '' => 'site/index',
                '<action:(login|logout|reg|clearCache|getInvites|editInvite)>' => 'site/<action>',
                '<module:rbac>' => '<module>',
                '<module:\w+>' => '<module>/default/index',
                '<module:\w+>/index' => '<module>/default/index',
                '<module:\w+>/<action>' => '<module>/default/<action>',
                '<module:\w+>/<action>/<id:\d+>' => '<module>/default/<action>',
            ),
        ),
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('10'),
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=walhall',
            'enableProfiling' => YII_DEBUG,
            'enableParamLogging' => YII_DEBUG,
            'username' => 'walhall',
            'password' => '5092503',
            'charset' => 'utf8',
            'schemaCachingDuration' => 86400,
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
            'routes' => array(
                array(
                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('91.200.183.133', '91.202.73.29', '91.202.73.30'),
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']    
    'params' => array(
        'adminEmail' => 'okyjiuct@gmail.com',
        'fromMail' => 'info@walhall.ru',
        'format' => "H:i",
    ),
);
