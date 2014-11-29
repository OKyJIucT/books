<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <div class="login-body">
            <div class="login-title"><strong>Авторизация</strong></div>

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
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => "Email")); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => "Пароль")); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <label>
                        <?php echo $form->checkBox($model, 'rememberMe'); ?>
                        <?php echo $form->label($model, 'rememberMe'); ?>
                    </label>
                </div>
            </div>

            <div class="row">
                <?php echo CHtml::submitButton('Войти', array('class' => 'btn btn-success btn-block col-lg-6')); ?>

                <a href="/reg" class="btn btn-warning btn-block col-lg-6">Регистрация</a>
            </div>


            <?php $this->endWidget(); ?>

        </div>
    </div>

</div>