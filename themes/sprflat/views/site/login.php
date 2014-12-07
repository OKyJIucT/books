<div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>

</div>

<div id="login" class="animated bounceIn">
    <img id="logo" src="/static/img/logo.png" alt="sprFlat Logo">
    <!-- Start .login-wrapper -->
    <div class="login-wrapper">
        <ul id="myTab" class="nav nav-tabs nav-justified bn">
            <li class="active">
                <a href="#log-in" data-toggle="tab">Авторизация</a>
            </li>
            <li class="">
                <a href="#register" data-toggle="tab">Регистрация</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content bn">
            <div class="tab-pane fade active in" id="log-in">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions' => array(
                        'class' => 'form-horizontal',
                        'role' => 'form'
                    )
                ));
                ?>

                <div class="form-group">
                    <div class="col-lg-12">
                        <?php echo $form->textField($model, 'username', array('class' => 'form-control left-icon', 'placeholder' => "Email")); ?>
                        <?php echo $form->error($model, 'username'); ?>
                        <i class="fa-user s16 left-input-icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control left-icon', 'placeholder' => "Пароль")); ?>
                        <?php echo $form->error($model, 'password'); ?>
                        <i class="fa-lock s16 left-input-icon"></i>
                        <span class="help-block"><a href="#"><small>Забыли пароль?</small></a></span> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                        <!-- col-lg-12 start here -->

                        <label class="checkbox">
                            <div class="icheckbox_flat-green" style="position: relative;">
                                <?php echo $form->checkBox($model, 'rememberMe', array('style' => "position: absolute; opacity: 0;")); ?>
                                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                            </div>
                            <?php echo $form->label($model, 'rememberMe'); ?>
                        </label>
                    </div>
                    <!-- col-lg-12 end here -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                        <!-- col-lg-12 start here -->
                        <?php echo CHtml::submitButton('Войти', array('class' => 'btn btn-success pull-right')); ?>
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="tab-pane fade" id="register">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'users-form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions' => array(
                        'class' => 'form-horizontal',
                        'role' => 'form'
                    )
                ));
                ?>


                <div class="form-group">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <?php echo $form->textField($reg, 'username', array('class' => 'form-control left-icon', 'placeholder' => "Логин")); ?>
                        <?php echo $form->error($reg, 'username'); ?>
                        <i class="fa-user s16 left-input-icon"></i> 
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <?php echo $form->textField($reg, 'email', array('class' => 'form-control left-icon', 'placeholder' => "Email")); ?>
                        <?php echo $form->error($reg, 'email'); ?>
                        <i class="fa-envelope s16 left-input-icon"></i> 
                    </div>
                    <!-- col-lg-12 end here -->
                    <div class="col-lg-12 mt15">
                        <!-- col-lg-12 start here -->
                        <?php echo $form->textField($reg, 'password', array('class' => 'form-control left-icon', 'placeholder' => "Пароль")); ?>
                        <?php echo $form->error($reg, 'password'); ?>
                        <i class="fa-lock s16 left-input-icon"></i> 
                    </div>
                    <!-- col-lg-12 end here -->
                    <div class="col-lg-12 mt15">
                        <!-- col-lg-12 start here -->
                        <?php echo $form->textField($reg, 'invite', array('class' => 'form-control left-icon', 'placeholder' => "Код приглашения")); ?>
                        <?php echo $form->error($reg, 'invite'); ?>
                        <i class="fa-key s16 left-input-icon"></i> 
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <?php echo CHtml::submitButton('Зарегистрироваться', array('class' => 'btn btn-success btn-block')); ?>
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <!-- End #.login-wrapper -->
</div>