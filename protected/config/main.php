<?php

$main_local = dirname(__FILE__) . '/main-local.php';
$db_local = dirname(__FILE__) . '/db-local.php';

return CMap::mergeArray(
    array(
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
                'password' => '5092503',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                    'ipFilters' => array('91.200.183.133', '91.202.73.29', '91.202.73.30'),
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
//                'class' => "ext.minScript.components.ExtMinScript",
//                'minScriptDebug' => true,
                'scriptMap' => array(
                    'jquery.js' => false,
                )
            ),
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
                ), /*
                  'routes' => array(
                  array(
                  'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                  'ipFilters' => array('91.200.183.133', '91.202.73.29', '91.202.73.30'),
                  ),
                  ), */
            ),
        ),
//        'controllerMap' => array(
//            'min' => array(
//                'class' => "ext.minScript.controllers.ExtMinScriptController",
//            )
//        ),
        // using Yii::app()->params['paramName']
        'params' => array(
            'fromMail' => 'info@bookswood.ru'
        ),
    ),
    file_exists($main_local) ? require $main_local : array(), file_exists($db_local) ? require $db_local : array()
);
