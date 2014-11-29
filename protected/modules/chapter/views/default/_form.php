<?php
/* @var $this ChapterController */
/* @var $model Chapter */
/* @var $form CActiveForm */
?>

<div class="col-lg-10 col-lg-offset-1">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'chapter-form',
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

    <div class="form-group form-horizontal">
        <label class="col-lg-3 control-label">Название документа</label>
        <div class="col-lg-9">
            <p class="form-control-static"><?php echo $doc->title; ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => "col-lg-3 control-label")); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => "Название главы")); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name_en', array('class' => "col-lg-3 control-label")); ?>
        <div class="col-lg-9">
            <?php echo $form->textField($model, 'name_en', array('class' => 'form-control', 'placeholder' => "Название главы")); ?>
            <?php echo $form->error($model, 'name_en'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12">
            <?php
            $this->widget('ImperaviRedactorWidget', array(
                // You can either use it for model attribute
                'model' => '',
                'value' => '',
                'attribute' => 'my_field',
                // or just for input field
                'name' => 'Chapter[text]',
                // Some options, see http://imperavi.com/redactor/docs/
                'options' => array(
                    'lang' => 'ru',
                    'toolbarFixed' => true,
                    'minHeight' => 400,
                    'maxHeight' => 400,
                    'shortcuts' => true
                ),
                'htmlOptions' => array(
                    'row' => '12',
                ),
            ));
            ?>
        </div>

    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label"></label>
        <div class="col-lg-9">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => "btn btn-success")); ?>
        </div>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->