<?php
/* @var $this DocsController */
/* @var $model Docs */
/* @var $form CActiveForm */
?>

<div class="col-md-8 col-md-offset-2">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'docs-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'class' => 'form-horizontal',
            'role' => 'form',
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>

    <div class="form-group">
        <label class="col-md-3 control-label">Название</label>
        <div class="col-md-9">
            <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => "Название документа")); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Оригинальное название</label>
        <div class="col-md-9">
            <?php echo $form->textField($model, 'title_en', array('class' => 'form-control', 'placeholder' => "Оригинальное название")); ?>
            <?php echo $form->error($model, 'title_en'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Автор</label>
        <div class="col-md-9">
            <?php echo $form->textField($model, 'author', array('class' => 'form-control', 'placeholder' => "Автор")); ?>
            <?php echo $form->error($model, 'author'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Обложка</label>
        <div class="col-md-9">
            <?php
            $this->widget('CMultiFileUpload', array(
                'model' => $model,
                'name' => 'thumb',
                'accept' => 'jpg|png',
                'max' => 1,
                'remove' => Yii::t('ui', 'Удалить'),
                'denied' => 'Запрещенный тип файла',
                'htmlOptions' => array(
                    'class' => "btn btn-success"
                ),
            ));
            ?>
            <?php echo $form->error($model, 'thumb'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Краткое описание</label>
        <div class="col-md-9">
            <?php echo $form->textArea($model, 'text', array('class' => 'form-control', 'placeholder' => "Краткое описание")); ?>
            <?php echo $form->error($model, 'text'); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-9">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => "btn btn-success")); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->