<?php
/* @var $this TranslateController */
/* @var $model Translate */

$this->breadcrumbs=array(
	'Translates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Translate', 'url'=>array('index')),
	array('label'=>'Create Translate', 'url'=>array('create')),
	array('label'=>'Update Translate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Translate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Translate', 'url'=>array('admin')),
);
?>

<h1>View Translate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'en_name',
		'user_id',
		'percent',
		'date',
		'type',
	),
)); ?>
