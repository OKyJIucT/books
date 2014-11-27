<?php
/* @var $this ChapterController */
/* @var $model Chapter */

$this->breadcrumbs = array(
    'Главы' => array('index'),
    'Добавить главу',
);
?>

<h1 class="text-center">Добавление главы</h1>

<div class="col-md-6 col-lg-offset-3">      

    <!-- START WARNING PANEL -->
    <div class="panel panel-warning">
        <div class="panel-heading ui-draggable-handle">
            <h3 class="panel-title">Инструкция</h3>
        </div>
        <div class="panel-body">
            <li>Укажите в соответствующих полях переведенное и оригинальное название главы.</li>
            <li>Нажмите кнопку "Выберите файл" и выберите текстовый файл с главой, которую хотите добавить.</li>
            <li>Если не выбирать файл, то на следующем шаге можно будет вставить в форму скопированный в буфер обмена текст.</li>
            <li>Нажмите кнопку "Добавить".</li>
        </div>                          
    </div>                        
    <!-- END DEFAULT PANEL -->

</div>

<?php $this->renderPartial('_form', array('model' => $model, 'doc' => $doc)); ?>