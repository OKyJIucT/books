<?php
/* @var $this ChapterController */
/* @var $model Chapter */

$this->breadcrumbs = array(
    'Chapters' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Chapter', 'url' => array('index')),
    array('label' => 'Create Chapter', 'url' => array('create')),
    array('label' => 'Update Chapter', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Chapter', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Chapter', 'url' => array('admin')),
);
?>

<h1>View Chapter #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'docs_id',
        'name',
        'user_id',
        'date',
    ),
));
?>
