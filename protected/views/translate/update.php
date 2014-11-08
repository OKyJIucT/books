<?php
/* @var $this TranslateController */
/* @var $model Translate */

$this->breadcrumbs=array(
	'Translates'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Translate', 'url'=>array('index')),
	array('label'=>'Create Translate', 'url'=>array('create')),
	array('label'=>'View Translate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Translate', 'url'=>array('admin')),
);
?>

<h1>Update Translate <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>