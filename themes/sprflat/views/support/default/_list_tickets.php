<div class="email-wrapper">
    <div class="email-list">
        <table class="table table-striped table-hover table-fixed-layout non-responsive">
            <tbody>
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '_view',
                    'ajaxUpdate' => true,
                    'template' => "{items}<div class='clearfix'></div><div class='pull-right mright'>{pager}</div>",
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
            </tbody>
        </table>
    </div>
</div>