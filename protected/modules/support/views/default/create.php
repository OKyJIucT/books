<?php
/* @var $this SupportController */
/* @var $model Support */

$this->breadcrumbs=array(
	'Supports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Support', 'url'=>array('index')),
	array('label'=>'Manage Support', 'url'=>array('admin')),
);
?>

<h1>Create Support</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>