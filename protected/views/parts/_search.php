<?php
/* @var $this PartsController */
/* @var $model Parts */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'docs_id'); ?>
        <?php echo $form->textField($model, 'docs_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'chapter_id'); ?>
        <?php echo $form->textField($model, 'chapter_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'version'); ?>
        <?php echo $form->textField($model, 'version', array('size' => 8, 'maxlength' => 8)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'date'); ?>
        <?php echo $form->textField($model, 'date'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->