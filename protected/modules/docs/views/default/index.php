<?php
/* @var $this DocsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Документы',
);
?>

<div class="col-md-12">
    <div class="btn-group">
        <a href="<?= Y::url('/docs/default/create'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
        <?php if (Y::hasAccess('administrator')) : ?>
            <a href="<?= Y::url('/docs/default/admin'); ?>" class="btn btn-warning"><i class="fa fa-cogs"></i> Управление</a>
        <?php endif; ?>   
    </div>
</div>

<div class="clearfix"></div>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view'
));
?>