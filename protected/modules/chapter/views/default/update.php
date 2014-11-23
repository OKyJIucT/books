<?php
/* @var $this ChapterController */
/* @var $model Chapter */

$this->breadcrumbs = array(
    'Главы' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Разбивка документа на главы',
);
?>

<h1>Разбивка документа на главы</h1>

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

    <?php
    $this->widget('ImperaviRedactorWidget', array(
        // You can either use it for model attribute
        'model' => '',
        'value' => file_get_contents('http://walhall.ru/documents' . Y::getDir($model->date) . $model->path),
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

    <div class="form-group">
        <div class="col-md-9">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', array('class' => "btn btn-success")); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>