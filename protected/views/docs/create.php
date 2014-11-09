<?php
/* @var $this DocsController */
/* @var $model Docs */

$this->breadcrumbs=array(
	'Документы'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'List Docs', 'url'=>array('index')),
	array('label'=>'Manage Docs', 'url'=>array('admin')),
);
?>

<h1 class="text-center">Добавление документа</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>