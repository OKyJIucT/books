<?php
/* @var $this SupportController */
/* @var $model Support */

$this->breadcrumbs=array(
	'Supports'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Support', 'url'=>array('index')),
	array('label'=>'Create Support', 'url'=>array('create')),
	array('label'=>'View Support', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Support', 'url'=>array('admin')),
);
?>

<h1>Update Support <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>