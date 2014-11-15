<?php
/* @var $this ChapterController */
/* @var $model Chapter */
/* @var $form CActiveForm */
?>

<div class="col-md-10 col-md-offset-1">

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
        <label class="col-md-3 control-label">Название документа</label>
        <div class="col-md-9">
            <p class="form-control-static"><?php echo $doc->title; ?></p>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => "col-md-3 control-label")); ?>
        <div class="col-md-9">
            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => "Название главы")); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name_en', array('class' => "col-md-3 control-label")); ?>
        <div class="col-md-9">
            <?php echo $form->textField($model, 'name_en', array('class' => 'form-control', 'placeholder' => "Название главы")); ?>
            <?php echo $form->error($model, 'name_en'); ?>
        </div>
    </div>

    <?php /*
      $this->widget('ImperaviRedactorWidget', array(
      // You can either use it for model attribute
      'model' => '',
      'attribute' => 'my_field',
      // or just for input field
      'name' => 'Chapter[text]',
      // Some options, see http://imperavi.com/redactor/docs/
      'options' => array(
      'lang' => 'ru',
      'toolbarFixed' => true,
      'minHeight' => 300,
      'maxHeight' => 800
      ),
      'htmlOptions' => array(
      'row' => '12',
      ),
      )); */
    ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'text', array('class' => "col-md-3 control-label")); ?>
        <div class="col-md-9">
            <?php
            $this->widget('CMultiFileUpload', array(
                'model' => $model,
                'name' => 'text',
                'accept' => 'txt',
                'max' => 1,
                'remove' => Yii::t('ui', 'Удалить'),
                'denied' => 'Запрещенный тип файла',
                'htmlOptions' => array(
                    'class' => "btn btn-success"
                ),
            ));
            ?>
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