<?php
/* @var $this PartsController */
/* @var $model Parts */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'parts-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'docs_id'); ?>
        <?php echo $form->textField($model, 'docs_id'); ?>
        <?php echo $form->error($model, 'docs_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'chapter_id'); ?>
        <?php echo $form->textField($model, 'chapter_id'); ?>
        <?php echo $form->error($model, 'chapter_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'version'); ?>
        <?php echo $form->textField($model, 'version', array('size' => 8, 'maxlength' => 8)); ?>
        <?php echo $form->error($model, 'version'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php echo $form->textField($model, 'date'); ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->