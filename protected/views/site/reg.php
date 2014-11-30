<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <div class="login-body">
            <div class="login-title"><strong>Регистрация</strong></div>

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
                <div class="col-md-12">
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => "Логин")); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => "Email")); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <?php echo $form->textField($model, 'password', array('class' => 'form-control', 'placeholder' => "Пароль")); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <?php echo $form->textField($model, 'invite', array('class' => 'form-control', 'placeholder' => "Код приглашения")); ?>
                    <?php echo $form->error($model, 'invite'); ?>
                </div>
            </div>

            <div class="row">
                <?php echo CHtml::submitButton('Зарегистрироваться', array('class' => 'btn btn-success btn-block col-md-6')); ?>

                <a href="/login" class="btn btn-warning btn-block col-md-6">Авторизация</a>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>