<?php
/* @var $this ChapterController */
/* @var $model Chapter */

$this->breadcrumbs = array(
    'Главы' => array('index'),
    'Добавить главу',
);
?>

<h1 class="text-center">Добавление главы</h1>

<div class="col-md-6 col-md-offset-3">      

    <!-- START WARNING PANEL -->
    <div class="panel panel-warning">
        <div class="panel-heading ui-draggable-handle">
            <h3 class="panel-title">Инструкция</h3>
        </div>
        <div class="panel-body">
            <li>Укажите в соответствующих полях переведенное и оригинальное название главы.</li>
            <li>Чтобы разбить главу на абзацы, поместите курсор в конец предполагаемой главы и нажмите на панели инструментов кнопку "Горизонтальная линейка".</li>
            <p><img class="text-center" src="/bootstrap/img/line.png" style="border: 1px solid #777" /></p>
            <li>Нажмите кнопку "Сохранить".</li>
        </div>                          
    </div>                        
    <!-- END DEFAULT PANEL -->

</div>

<?php $this->renderPartial('_form', array('model' => $model, 'doc' => $doc)); ?>