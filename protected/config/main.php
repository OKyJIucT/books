<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Сообщество переводчиков',
    'id' => 'books-translate',
    'theme' => 'sprflat',
    'language' => 'ru',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.YiiMailer.*',
        'application.modules.access.models.*',
        'application.modules.chapter.models.*',
        'application.modules.docs.models.*',
        'application.modules.parts.models.*',
        'application.modules.rbacui.models.*',
        'application.modules.redis.models.*',
        'application.modules.support.models.*',
        'application.modules.users.models.*',
        'application.modules.version.models.*',
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
            'password' => '',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array(),
        ),
        'access',
        'chapter',
        'docs',
        'parts',
        'support',
        'users',
        'version',
    ),
    // application components
    'components' => array(
        'clientScript' => array(
            'class' => "ext.minScript.components.ExtMinScript",
//                'minScriptLmCache' => 600,
            'packages' => array(
                // Уникальное имя пакета
                'ZeroClipboard' => array(
                    // Где искать подключаемые файлы JS и CSS
                    'baseUrl' => '/static/js/',
                    'js' => array('ZeroClipboard.min.js'),
                    // Зависимость от другого пакета
                    'depends' => array('jquery'),
                ),
            )
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
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
        'db' => require(dirname(__FILE__) . '/database.php'),
        'user' => array(
            'class' => 'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'cache' => array(
            'class' => 'CMemCache',
            'servers' => array(
                array(
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 60,
                )
            ),
            'behaviors' => array(
                'clear' => array(
                    'class' => 'application.components.TaggingBehavior',
                ),
            ),
        ),
        'file' => array(
            'class' => 'application.extensions.file.CFile',
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('user'),
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
        ),
    ),
    'controllerMap' => array(
        'min' => array(
            'class' => "ext.minScript.controllers.ExtMinScriptController",
        )
    ),
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);
