<?php
$this->breadcrumbs = array(
    $data->docs->title . ' - ' . $data->chapter->name,
);
?>

<div class="view">

    <div class="col-md-5">
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
    <div class="col-md-5 translate">
        <?php
        echo CHtml::form();
        echo CHtml::hiddenField('part_id', $data->id);

        echo CHtml::ajaxSubmitButton('Сохранить', '/parts/saveTranslate', array(
            'type' => 'POST',
            // Результат запроса записываем в элемент, найденный
            // по CSS-селектору #output.
            'update' => '#test',
            'success' => 'js:function(data){
                    $(".btn-' . $data->id . '").val(data).removeClass("btn-warning").addClass("btn-success");
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
            'value' => $data->text,
            'attribute' => 'text',
            // or just for input field
            'name' => 'Part[translate][' . $data->id . ']',
            // Some options, see http://imperavi.com/redactor/docs/
            'options' => array(
                'toolbar' => false,
//                'minHeight' => 250,
//                'maxHeight' => 250,
                'keyupCallback' => 'js: function(){
                    $(".btn-' . $data->id . '").val("Сохранить").removeClass("btn-success").addClass("btn-warning");
                 }',
            ),
            'htmlOptions' => array(
                'row' => '12'
            ),
        ));

        echo CHtml::endForm();
        ?>
        <script>
            $(".redactor-editor").change(function () {
                alert(123);
            });
        </script>
    </div>
    <div class="col-md-2">
        Комментарии
    </div>
    <div class="clearfix"></div>

</div>