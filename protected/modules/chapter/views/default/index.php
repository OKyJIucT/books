<div class="col-md-12">
    <h1><?= $dataProvider->getData()[0]->docs->title . ' - ' . $dataProvider->getData()[0]->chapter->name; ?></h1>
</div>

<div id="test"></div>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'ajaxUpdate' => false,
    'template' => "<div class='col-md-12'>{pager}<div class='clearfix'></div>{items}<div class='clearfix'></div>{pager}</div>",
    'pager' => array(
        'maxButtonCount' => '10',
        'prevPageLabel' => '',
        'firstPageLabel' => 'Первая',
        'nextPageLabel' => '',
        'lastPageLabel' => 'Последняя',
        'header' => '',
        'htmlOptions' => array('class' => 'pagination pagination-sm pull-left push-down-20'),
        'firstPageCssClass' => '', //default "first"
        'lastPageCssClass' => '', //default "last"
        'previousPageCssClass' => 'hidden', //default "previours"
        'nextPageCssClass' => 'hidden', //default "next"
        'internalPageCssClass' => '', //default "page"
        'selectedPageCssClass' => 'active', //default "selected"
        'hiddenPageCssClass' => ''//default "hidden"
    ),
));
?>