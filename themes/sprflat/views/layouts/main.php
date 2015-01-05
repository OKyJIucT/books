<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Import google fonts - Heading first/ text second -->
        <link rel='stylesheet' type='text/css'
              href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700'/>
        <!--[if lt IE 9]>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css"/>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css"/>
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css"/>
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css"/>
        <![endif]-->
        <?php
        Yii::app()->clientScript->registerCssFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/css/main.min.css'
            )
        );

        Yii::app()->clientScript->registerPackage('jquery', CClientScript::POS_END);

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/plugins/core/pace/pace.min.js'
            ), CClientScript::POS_END
        );
        ?>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="/static/js/libs/excanvas.min.js"></script>
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script type="text/javascript" src="/static/js/libs/respond.min.js"></script>
        <![endif]-->

        <link rel="icon" href="/favicon.ico" type="image/png">

        <title><?php echo CHtml::encode($this->pageTitle . ' - ' . Yii::app()->name); ?></title>
    </head>
    <body>

        <div id="header">
            <div class="container-fluid">
                <div class="navbar">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">
                            <img src="/static/img/logo.png" class="im-windows8 text-logo-element animated bounceIn"/>
                        </a>
                    </div>
                    <nav class="top-nav" role="navigation">
                        <ul class="nav navbar-nav pull-left">
                            <li class="<?php echo Yii::app()->controller->getId() == 'site' && $this->action->id == 'index' ? 'hover' : ''; ?>">
                                <a href="/"><i class="fa-home"></i> Главная</a>
                            </li>
                            <li class="<?php echo Yii::app()->controller->module->id == 'docs' || Yii::app()->controller->module->id == 'chapter' ? 'hover' : ''; ?>">
                                <a href="/docs"><i class="fa-group"></i> Переводы <span
                                        class="notification"><?= Y::countDocs(); ?></span></a>
                            </li>
                            <?php if (Y::hasAccess('administrator')) : ?>
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown"><i class="fa-star"></i> Админ-меню</a>
                                    <ul class="dropdown-menu email" role="menu">
                                        <li>
                                            <a href="<?= Y::url('/rbac/default/index'); ?>"><i class="fa-lock"></i> Роли
                                                пользователей</a>
                                        </li>
                                        <li>
                                            <a href="<?= Y::url('/site/clearCache'); ?>"><i class="fa-trash"></i>
                                                Очистить
                                                кеш</a>
                                        </li>
                                        <li>
                                            <a href="<?= Y::url('/site/getInvites'); ?>"><i class="fa-key"></i>
                                                Сгенерировать
                                                инвайты</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <ul class="nav navbar-nav pull-right">
                            <li class="<?php echo Yii::app()->controller->module->id == 'support' ? 'hover' : ''; ?>">
                                <a href="/support"><i class="fa-bullhorn"></i> Поддержка <?= Y::countTickets(); ?></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown">
                                    <i class="fa-user"></i>  <?= Yii::app()->user->name; ?>
                                </a>
                                <ul class="dropdown-menu right" role="menu">
                                    <li>
                                        <a href="<?= Y::url('/users/default/view', array('id' => Yii::app()->user->id)); ?>"><i
                                                class="st-settings"></i> Настройки</a>
                                    </li>
                                    <li>
                                        <a href="/logout"><i class="im-exit"></i> Выход</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Start #header-area -->
                <div id="header-area" class="fadeInDown">
                    <div class="header-area-inner">
                        <ul class="list-unstyled list-inline">
                            <li>
                                <div class="shortcut-button">
                                    <a href="#">
                                        <i class="im-pie"></i>
                                        <span>Earning Stats</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="shortcut-button">
                                    <a href="#">
                                        <i class="ec-images color-dark"></i>
                                        <span>Gallery</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="shortcut-button">
                                    <a href="#">
                                        <i class="en-light-bulb color-orange"></i>
                                        <span>Fresh ideas</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="shortcut-button">
                                    <a href="#">
                                        <i class="ec-link color-blue"></i>
                                        <span>Links</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="shortcut-button">
                                    <a href="#">
                                        <i class="ec-support color-red"></i>
                                        <span>Support</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="shortcut-button">
                                    <a href="#">
                                        <i class="st-lock color-teal"></i>
                                        <span>Lock area</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="full-page">

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'separator' => '&nbsp;&nbsp;<i class="fa-angle-right"></i>&nbsp;',
                ));
                ?>
            <?php endif; ?>

            <?php echo $content; ?>

            <div class="col-md-12"><?php Y::stats(); ?></div>

            <div class="clearfix"></div>
        </div>

        <?php
        if (Yii::app()->controller->module->id == 'users' && $this->action->id == 'view') {
            Yii::app()->clientScript->registerPackage('ZeroClipboard');
        }
        ?>
        <script>
            $('.dropdown-menu').addClass('animated fadeInUp');
        </script>
        <!-- Yandex.Metrika counter -->
        <script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
        <script type="text/javascript">try {
                var yaCounter27399752 = new Ya.Metrika({id: 27399752});
            } catch (e) {
            }</script>
        <noscript>
            <div><img src="//mc.yandex.ru/watch/27399752" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->
    </body>
</html>
