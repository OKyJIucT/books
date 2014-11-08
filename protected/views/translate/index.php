<?php
/* @var $this TranslateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Translates',
);

$this->menu=array(
	array('label'=>'Create Translate', 'url'=>array('create')),
	array('label'=>'Manage Translate', 'url'=>array('admin')),
);
?>

<h1>Translates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
