<?php
$this->pageTitle = $data->docs->title . ' - ' . $data->chapter->name;
$this->breadcrumbs = array(
    'Документы' => Y::url('/docs/default/index'),
    $data->docs->title => Y::url('/docs/default/view', array('id' => $data->docs->id)),
    $data->chapter->name,
);
?>

<div class="view">
    <div class="col-lg-5 number-mother">
        <span class="number">#<?= $index + 1 + Yii::app()->request->getParam('Parts_page') * 10; ?></span>
        <?php
        $this->widget('ImperaviRedactorWidget', array(
            // You can either use it for model attribute
            'model' => '',
            'value' => $data->text,
            'attribute' => 'text',
            // or just for input field
            'name' => 'Part[original][' . $data->id . ']',
            // Some options, see http://imperavi.com/redactor/docs/
            'options' => array(
                'toolbar' => false,
//                'minHeight' => 250,
//                'maxHeight' => 250
            ),
            'htmlOptions' => array(
                'row' => '12',
            ),
        ));
        ?>
    </div>

    <div class="col-lg-5">
        <?php
        if ($data->versions) {
            $my = 0;
            foreach ($data->versions as $version) {

                // если чужой перевод
                if ($version->user_id != Yii::app()->user->id) {
                    echo CHtml::form('', 'post', array('class' => 'translate'));

                    echo '<span class="label label-info btn-translate-left">' . $version->user->username . '</span>';
                    echo '<span class="label label-info btn-translate-right">Сохранено: ' . date("d-M-Y, H:i", $version->date) . '</span>';

                    $this->widget('ImperaviRedactorWidget', array(
                        // You can either use it for model attribute
                        'model' => '',
                        'value' => $version->text,
                        'attribute' => 'text',
                        'name' => 'translate[' . $version->hash . ']',
                        'options' => array(
                            'toolbar' => false,
                            'keyupCallback' => 'js: function(){
                    $(".btn-' . $version->hash . '").val("Сохранить").removeClass("btn-success").addClass("btn-warning");
                 }',
                        ),
                        'htmlOptions' => array(
                            'row' => '12',
                            'style' => 'padding-bottom: 20px;'
                        ),
                    ));

                    echo CHtml::endForm();
                } else { // если свой перевод
                    $my = 1;
                    echo CHtml::form('', 'post', array('class' => 'translate'));
                    echo CHtml::hiddenField('part_id', $version->part_id);

                    echo CHtml::ajaxSubmitButton('Сохранить', '/parts/saveTranslate', array(
                        'type' => 'POST',
                        'success' => 'js:function(data){
                    $(".btn-' . $version->hash . '").val("Сохранено").removeClass("btn-warning").addClass("btn-success");
                }'
                            ), array(
                        // Меняем тип элемента на submit, чтобы у пользователей
                        // с отключенным JavaScript всё было хорошо.
                        'type' => 'submit',
                        'class' => 'btn btn-sm btn-warning btn-translate btn-' . $version->hash,
                        'name' => 'save-' . $version->hash,
                            )
                    );

                    $this->widget('ImperaviRedactorWidget', array(
                        // You can either use it for model attribute
                        'model' => '',
                        'value' => $version->text ? $version->text : '',
                        'attribute' => 'text',
                        'name' => 'translate[' . $version->hash . ']',
                        'options' => array(
                            'toolbar' => false,
                            'keyupCallback' => 'js: function(){
                    $(".btn-' . $version->hash . '").val("Сохранить").removeClass("btn-success").addClass("btn-warning");
                 }',
                        ),
                        'htmlOptions' => array(
                            'row' => '12'
                        ),
                    ));

                    echo CHtml::endForm();
                }
            }

            // если есть версии, но нет моей
            if ($my != 1) {
                echo CHtml::form('', 'post', array('class' => 'translate'));
                echo CHtml::hiddenField('part_id', $data->id);

                echo CHtml::ajaxSubmitButton('Сохранить', '/parts/saveTranslate', array(
                    'type' => 'POST', 'success' => 'js:function(data){
                    $(".btn-' . $data->id . '").val("Сохранено").removeClass("btn-warning").addClass("btn-success");
                }'
                        ), array(
                    // Меняем тип элемента на submit, чтобы у пользователей
                    // с отключенным JavaScript всё было хорошо.
                    'type' => 'submit',
                    'class' => 'btn btn-sm btn-warning btn-translate btn-' . $data->id,
                    'name' => 'save-' . $data->id,
                        )
                );

                $this->widget('ImperaviRedactorWidget', array(
                    // You can either use it for model attribute
                    'model' => '',
                    'value' => '',
                    'attribute' => 'text',
                    'name' => 'translate[' . $data->id . ']',
                    'options' => array(
                        'toolbar' => false,
                        'keyupCallback' => 'js: function(){
                    $(".btn-' . $data->id . '").val("Сохранить").removeClass("btn-success").addClass("btn-warning");
                 }',
                    ),
                    'htmlOptions' => array(
                        'row' => '12'
                    ),
                ));

                echo CHtml::endForm();
            }
        } else {
            echo CHtml::form('', 'post', array('class' => 'translate'));
            echo CHtml::hiddenField('part_id', $data->id);

            echo CHtml::ajaxSubmitButton('Сохранить', '/parts/saveTranslate', array(
                'type' => 'POST',
                'success' => 'js:function(data){
                    $(".btn-' . $data->id . '").val("Сохранено").removeClass("btn-warning").addClass("btn-success");
                }'
                    ), array(
                // Меняем тип элемента на submit, чтобы у пользователей
                // с отключенным JavaScript всё было хорошо.
                'type' => 'submit',
                'class' => 'btn btn-sm btn-warning btn-translate btn-' . $data->id,
                'name' => 'save-' . $data->id,
                    )
            );

            $this->widget('ImperaviRedactorWidget', array(
                'model' => '',
                'value' => '',
                'attribute' => 'text',
                'name' => 'translate[' . $data->id . ']',
                'options' => array(
                    'toolbar' => false,
                    'keyupCallback' => 'js: function(){
                    $(".btn-' . $data->id . '").val("Сохранить").removeClass("btn-success").addClass("btn-warning");
                 }',
                ),
                'htmlOptions' => array(
                    'row' => '12'
                ),
            ));

            echo CHtml::endForm();
        }
        ?> 
    </div>
    <div class="col-lg-2">
        Комментарии
    </div>
    <div class="clearfix"></div>

</div>