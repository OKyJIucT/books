<?php
/* @var $this DocsController */
/* @var $model Docs */

$this->breadcrumbs = array(
    'Документы' => array('index'),
    'Добавить документ',
);
?>

<h1 class="text-center">Добавление документа</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>