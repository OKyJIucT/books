<?php
$v = 100;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/bootstrap/css/theme-default.css?'.$v); ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <?php
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::app()->request->baseUrl . 'bootstrap/js/bootstrap.min.js'
                ), CClientScript::POS_END
        );
        ?>
        <title><?php echo CHtml::encode($this->pageTitle . ' - ' . Yii::app()->name); ?></title>
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">



            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">

                    <li class="xn-logo">
                        <a href="/">ATLANT</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>

                    <li <?php echo Yii::app()->controller->getId() == 'site' && $this->action->id == 'index' ? 'class="hover"' : ''; ?>>
                        <a href="/"><span class="fa fa-desktop"></span> <span class="xn-text">Главная</span></a>                        
                    </li> 
                    <li class="xn-openable <?php echo Yii::app()->controller->module->id == 'docs' ? 'hover' : ''; ?>">
                        <a href="<?= Y::url('/docs'); ?>"><span class="fa fa-group"></span> <span class="xn-text">Переводы</span></a>
                        <ul>
                            <li <?php echo Yii::app()->controller->module->id == 'docs' && $this->action->id == 'create' ? 'class="active"' : ''; ?>>
                                <a href="<?= Y::url('/docs/default/create'); ?>"><span class="fa fa-plus"></span> Добавить</a>                        
                            </li>
                            <li <?php echo Yii::app()->controller->module->id == 'docs' && $this->action->id == 'index' ? 'class="active"' : ''; ?>>
                                <a href="<?= Y::url('/docs/default/index'); ?>"><span class="fa fa-list"></span> Все переводы</a> 
                                <div class="informer informer-warning"><?php echo Docs::countDocs(); ?></div>
                            </li>  
                            <?php if (Y::hasAccess('administrator')) : ?>
                                <li <?php echo Yii::app()->controller->module->id == 'docs' && $this->action->id == 'admin' ? 'class="active"' : ''; ?>>
                                    <a href="<?= Y::url('/docs/default/admin'); ?>"><span class="fa fa-cogs"></span> Управление</a> 
                                </li> 
                            <?php endif; ?>
                        </ul>
                    </li> 
                    <?php if (Y::hasAccess('administrator')) : ?>
                        <li class="xn-openable">
                            <a href="#"><span class="fa fa-star"></span> <span class="xn-text">Админ-меню</span></a>
                            <ul>
                                <li>
                                    <a href="<?= Y::url('/rbac/default/index'); ?>"><span class="fa fa-lock"></span> Роли пользователей</a>                        
                                </li>
                                <li>
                                    <a href="<?= Y::url('/site/clearCache'); ?>"><span class="fa fa-trash-o"></span> Очистить кеш</a>                        
                                </li>
                                <li>
                                    <a href="<?= Y::url('/site/getInvites'); ?>"><span class="fa fa-key"></span> Сгенерировать инвайты</a>                        
                                </li>                           
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <li class="xn-openable pull-right <?php echo Yii::app()->controller->module->id == 'users' ? 'hover' : ''; ?>">
                        <a href="<?= Y::url('/users'); ?>"><span class="fa fa-user"></span> <span class="xn-text"><?= Yii::app()->user->name; ?></span></a>
                        <ul>
                            <li <?php echo Yii::app()->controller->module->id == 'users' && $this->action->id == 'create' ? 'class="active"' : ''; ?>>
                                <a href="<?= Y::url('/'); ?>"><span class="fa fa-envelope-o"></span> Сообщения</a>                        
                            </li>
                            <li <?php echo Yii::app()->controller->module->id == 'users' && $this->action->id == 'index' ? 'class="active"' : ''; ?>>
                                <a href="<?= Y::url('/'); ?>"><span class="fa fa-pencil"></span> Мои переводы</a> 
                                <div class="informer informer-warning"><?php echo Docs::countDocs(); ?></div>
                            </li>
                            <li <?php echo Yii::app()->controller->module->id == 'users' && $this->action->id == 'index' ? 'class="active"' : ''; ?>>
                                <a href="<?= Y::url('/'); ?>"><span class="fa fa-star"></span> Закладки</a> 
                                <div class="informer informer-warning"><?php echo Docs::countDocs(); ?></div>
                            </li>
                            <li <?php echo Yii::app()->controller->module->id == 'users' && $this->action->id == 'index' ? 'class="active"' : ''; ?>>
                                <a href="<?= Y::url('/users/default/view', array('id' => Yii::app()->user->id)); ?>"><span class="fa fa-cogs"></span> Настройки</a> 
                                <div class="informer informer-warning"><?php echo Docs::countDocs(); ?></div>
                            </li>
                        </ul>
                    </li> 
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     

                <!-- START BREADCRUMB -->
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif; ?>
                <!-- END BREADCRUMB -->                       

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START WIDGETS -->                    
                    <?php echo $content; ?>
                    <div class="clear"></div>
                    <div class="col-md-12"><?php Y::stats(); ?></div>
                    <!-- END WIDGETS -->                    


                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span><strong>Выйти</strong> ?</div>
                    <div class="mb-content">
                        <p>Вы действительно хотите выйти?</p>   
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="/logout" class="btn btn-success btn-lg">Да</a>
                            <button class="btn btn-default btn-lg mb-control-close">Нет</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="/bootstrap/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="/bootstrap/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="/bootstrap/js/plugins/jquery/jquery-ui.min.js"></script>      
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type="text/javascript" src="/bootstrap/js/plugins/icheck/icheck.min.js"></script>        
        <script type="text/javascript" src="/bootstrap/js/plugins/mcustomscrollbar/jquery.mcustomscrollbar.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        <script type="text/javascript" src="/bootstrap/js/plugins/morris/raphael-min.js"></script>
        
        <script type="text/javascript" src="/bootstrap/js/plugins/bootstrap/bootstrap-select.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="/bootstrap/js/plugins.js"></script>       
        <script type="text/javascript" src="/bootstrap/js/actions.js"></script>
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->         

        <div id="topcontrol" title="Scroll Back to Top" style="position: fixed; bottom: 10px; right: 10px; opacity: 0; cursor: pointer;">
            <!-- TO TOP --><div class="to-top"><span class="fa fa-angle-up"></span></div><!-- END TO TOP -->
        </div>
        <div class="jvectormap-label"></div>
        <?php
        if (Yii::app()->controller->module->id == 'users' && $this->action->id == 'view') {
            Yii::app()->clientScript->registerScriptFile(
                    Yii::app()->request->baseUrl . '/bootstrap/js/ZeroClipboard.min.js'
            );
        }
        ?>

    </body>
</html>
