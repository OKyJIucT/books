<?php
/* @var $this DocsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Служба поддержки',
);
?>

<div class="col-md-8">
    <div class="block">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading ui-draggable-handle">
                        <h3 class="panel-title">Внимание!</h3>
                    </div>
                    <div class="panel-body">
                        <li>Быстрое решение проблемы напрямую зависит от правильности составления тикета.</li>
                        <li>Старайтесь кратко и ёмко описать проблему или предложение для разработки.</li>
                        <li>При возникновении какой-либо проблемы по возможности добавляйте скриншоты, а также указывайте ссылку, по которой у вас наблюдаются проблемы.</li>
                    </div>                          
                </div>                        
            </div>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'support-form',
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'role' => 'form'
            )
        ));
        ?>
        <div class="form-group">
            <div class="col-md-10">
                <?php echo $form->textField($model, 'name', array('placeholder' => "Укажите тему сообщения", 'class' => "form-control", 'required' => true)); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
            <div class="col-md-2control-label ">
                <?php
                echo CHtml::htmlButton('Создать тикет', array(
                    'name' => 'saveTicket',
                    'value' => "save",
                    'class' => 'btn btn-success',
                    'type' => 'submit'
                        )
                );
                ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <?php
                $this->widget('ImperaviRedactorWidget', array(
                    // You can either use it for model attribute
                    'model' => $model,
                    'value' => '',
                    'attribute' => 'text',
                    'name' => 'text',
                    'options' => array(
                        'toolbar' => true,
                        'minHeight' => 100
                    ),
                    'htmlOptions' => array(
                        'row' => '12',
                        'required' => true
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'text'); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>

<div class="col-md-4">
    <?php echo $this->renderPartial('_list_tickets', array('dataProvider' => $dataProvider)); ?>
</div>