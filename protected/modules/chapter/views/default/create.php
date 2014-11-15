<?php
/* @var $this ChapterController */
/* @var $model Chapter */

$this->breadcrumbs = array(
    'Главы' => array('index'),
    'Добавить главу',
);

?>

<h1 class="text-center">Добавление главы</h1>

<?php $this->renderPartial('_form', array('model' => $model, 'doc' => $doc)); ?>