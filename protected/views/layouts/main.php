<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/bootstrap/css/theme-default.css'); ?>
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
        <div class="page-container page-navigation-top-fixed">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar page-sidebar-fixed scroll mCustomScrollbar _mCS_1 mCS-autoHide">
                <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0">
                    <div id="mCSB_1_container" class="mCSB_container" dir="ltr">
                        <!-- START X-NAVIGATION -->
                        <ul class="x-navigation x-navigation-custom">
                            <li class="xn-logo">
                                <a href="/">Walhall</a>
                                <a href="#" class="x-navigation-control"></a>
                            </li>
                            <li class="xn-profile">
                                <a href="#" class="profile-mini">
                                    <img src="/assets/images/users/avatar.jpg" alt="John Doe">
                                </a>
                                <div class="profile">
                                    <div class="profile-image">
                                        <img src="/assets/images/users/avatar.png" />
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"><?php echo Yii::app()->user->name; ?></div>
                                        <div class="profile-data-title">
                                            <?php
                                            if (Y::hasAccess('administrator')) {
                                                echo 'Администратор';
                                            } elseif (Y::hasAccess('redactor')) {
                                                echo 'Редактор';
                                            } else
                                                echo 'Переводчик';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="profile-controls">
                                        <a href="<?= Y::url('users/view', array('id' => Yii::app()->user->id)); ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                                        <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                                    </div>
                                </div>                                                                        
                            </li>
                            <li <?php echo Yii::app()->controller->getId() == 'site' && $this->action->id == 'index' ? 'class="active"' : ''; ?>>
                                <a href="/"><span class="fa fa-desktop"></span> <span class="xn-text">Главная</span></a>                        
                            </li> 
                            <li class="xn-openable <?php echo Yii::app()->controller->module->id == 'docs' ? 'active' : ''; ?>">
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
                                            <a href="<?= Y::url('/rbac'); ?>"><span class="fa fa-lock"></span> Роли пользователей</a>                        
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
                        </ul>
                        <!-- END X-NAVIGATION -->
                    </div>
                    <div id="mCSB_1_scrollbar_vertical"></div>
                </div>
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-comments"></span></a>
                        <div class="informer informer-danger">4</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging ui-draggable">
                            <div class="panel-heading ui-draggable-handle">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                                <div class="pull-right">
                                    <span class="label label-danger">4 new</span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll mCustomScrollbar _mCS_2 mCS-autoHide mCS_no_scrollbar" style="height: 200px;"><div id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0">
                                    <div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position: relative; top: 0px; left: 0px;" dir="ltr">
                                        <a href="#" class="list-group-item">
                                            <div class="list-group-status status-online"></div>
                                            <img src="/assets/images/users/user2.jpg" class="pull-left" alt="John Doe">
                                            <span class="contacts-title">John Doe</span>
                                            <p>Praesent placerat tellus id augue condimentum</p>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="list-group-status status-away"></div>
                                            <img src="/assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk">
                                            <span class="contacts-title">Dmitry Ivaniuk</span>
                                            <p>Donec risus sapien, sagittis et magna quis</p>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="list-group-status status-away"></div>
                                            <img src="/assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali">
                                            <span class="contacts-title">Nadia Ali</span>
                                            <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="list-group-status status-offline"></div>
                                            <img src="/assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader">
                                            <span class="contacts-title">Darth Vader</span>
                                            <p>I want my money back!</p>
                                        </a>
                                    </div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>     
                            <div class="panel-footer text-center">
                                <a href="pages-messages.html">Show all messages</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-tasks"></span></a>
                        <div class="informer informer-warning">3</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging ui-draggable">
                            <div class="panel-heading ui-draggable-handle">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>                                
                                <div class="pull-right">
                                    <span class="label label-warning">3 active</span>
                                </div>
                            </div>
                            <div class="panel-body list-group scroll mCustomScrollbar _mCS_3 mCS-autoHide mCS_no_scrollbar" style="height: 200px;"><div id="mCSB_3" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0"><div id="mCSB_3_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position: relative; top: 0px; left: 0px;" dir="ltr">                                
                                        <a class="list-group-item" href="#">
                                            <strong>Phasellus augue arcu, elementum</strong>
                                            <div class="progress progress-small progress-striped active">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                            </div>
                                            <small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>
                                        </a>
                                        <a class="list-group-item" href="#">
                                            <strong>Aenean ac cursus</strong>
                                            <div class="progress progress-small progress-striped active">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                            </div>
                                            <small class="text-muted">Dmitry Ivaniuk, 24 Sep 2014 / 80%</small>
                                        </a>
                                        <a class="list-group-item" href="#">
                                            <strong>Lorem ipsum dolor</strong>
                                            <div class="progress progress-small progress-striped active">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                                            </div>
                                            <small class="text-muted">John Doe, 23 Sep 2014 / 95%</small>
                                        </a>
                                        <a class="list-group-item" href="#">
                                            <strong>Cras suscipit ac quam at tincidunt.</strong>
                                            <div class="progress progress-small">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                            </div>
                                            <small class="text-muted">John Doe, 21 Sep 2014 /</small><small class="text-success"> Done</small>
                                        </a>                                
                                    </div><div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>     
                            <div class="panel-footer text-center">
                                <a href="pages-tasks.html">Show all tasks</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END TASKS -->
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
                    <div class="row">
                        <?php echo $content; ?>
                        <div class="clear"></div>
                        <div class="col-md-12"><?php Y::stats(); ?></div>
                    </div>
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
