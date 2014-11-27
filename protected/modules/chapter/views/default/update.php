<?php
/* @var $this ChapterController */
/* @var $model Chapter */

$this->breadcrumbs = array(
    'Главы' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Разбивка документа на главы',
);
?>

<h1 class="text-center">Разбивка документа на главы</h1>

<div class="col-md-6 col-lg-offset-3"> 
    <!-- START WARNING PANEL -->
    <div class="panel panel-warning">
        <div class="panel-heading ui-draggable-handle">
            <h3 class="panel-title">Инструкция</h3>
        </div>
        <div class="panel-body">
            <li>Чтобы разбить главу на абзацы, поместите курсор в конец предполагаемой главы и нажмите на панели инструментов кнопку "Горизонтальная линейка".</li>
            <p><img class="text-center" src="/bootstrap/img/line.png" style="border: 1px solid #777" /></p>
            <li>После окончания разбития текста на абзацы ражмите кнопку "Сохранить".</li>
        </div>                          
    </div>                        
    <!-- END DEFAULT PANEL -->
</div>

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
        'value' => file_get_contents(Yii::app()->request->getBaseUrl(true) . '/documents' . Y::getDir($model->date) . $model->path),
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