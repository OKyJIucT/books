<?php
/* @var $this SupportController */
/* @var $model Support */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'support-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->textField($model, 'status', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'create'); ?>
        <?php echo $form->textField($model, 'create'); ?>
        <?php echo $form->error($model, 'create'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'last_update'); ?>
        <?php echo $form->textField($model, 'last_update'); ?>
        <?php echo $form->error($model, 'last_update'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'read'); ?>
        <?php echo $form->textField($model, 'read', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'read'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'support_read'); ?>
        <?php echo $form->textField($model, 'support_read', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'support_read'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->