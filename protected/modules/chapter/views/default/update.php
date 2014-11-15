<?php
/* @var $this ChapterController */
/* @var $model Chapter */

$this->breadcrumbs = array(
    'Главы' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

?>

<h1>Update Chapter <?php echo $model->id; ?></h1>

<?php
//Y::dump(Y::getDir($model->date, 'documents') . $model->path);
$this->widget('ImperaviRedactorWidget', array(
    // You can either use it for model attribute
    'model' => '',
    'value' => file_get_contents('http://walhall.ru/documents'.Y::getDir($model->date) . $model->path),
    'attribute' => 'my_field',
    // or just for input field
    'name' => 'Chapter[text]',
    // Some options, see http://imperavi.com/redactor/docs/
    'options' => array(
        'lang' => 'ru',
        'toolbarFixed' => true,
        'minHeight' => 400,
        'maxHeight' => 400
    ),
    'htmlOptions' => array(
        'row' => '12',
    ),
));
?>