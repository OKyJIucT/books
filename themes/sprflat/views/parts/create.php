<?php
/* @var $this PartsController */
/* @var $model Parts */

$this->breadcrumbs = array(
    'Parts' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Parts', 'url' => array('index')),
    array('label' => 'Manage Parts', 'url' => array('admin')),
);
?>

    <h1>Create Parts</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>