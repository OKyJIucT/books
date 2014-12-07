<?php
/* @var $this SupportController */
/* @var $model Support */

$this->breadcrumbs = array(
    'Служба поддержки' => array('index'),
    '#' . $model->id . ' ' . $model->name,
);
?>
<div class="row">
    <div class="col-md-8">
        <div class="block">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'support-form',
                'enableClientValidation' => false,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                ),
                'htmlOptions' => array(
                    'class' => 'form-horizontal',
                    'role' => 'form'
                )
            ));
            ?>

            <div class="form-group">
                <?php
                $this->widget('ImperaviRedactorWidget', array(
                    // You can either use it for model attribute
                    'model' => $model,
                    'value' => '',
                    'attribute' => 'text',
                    'name' => 'text',
                    'options' => array(
                        'toolbar' => false,
                        'minHeight' => 100
                    ),
                    'htmlOptions' => array(
                        'row' => '12',
                        'required' => true
                    ),
                ));
                echo CHtml::htmlButton('Отправить', array(
                    'name' => 'saveTicket',
                    'value' => "save",
                    'class' => 'btn btn-success mbottom pull-right',
                    'type' => 'submit'
                        )
                );
                ?>
                <?php echo $form->error($model, 'text'); ?>
            </div>

            <?php $this->endWidget(); ?>

            <?php
            foreach ($model->supportMsgs as $message) {

                if (Y::hasAccess('administrator')) {
                    if ($message->user_id != Yii::app()->user->id) {
                        $panel = 'panel-warning';
                        $author = $message->user->username;
                    } else {
                        $panel = 'panel-default';
                        $author = 'Вы написали';
                    }
                } else {
                    if ($message->user_id != Yii::app()->user->id) {
                        $panel = 'panel-warning';
                        $author = 'Ответ от службы поддержки';
                    } else {
                        $panel = 'panel-default';
                        $author = 'Вы написали';
                    }
                }
                ?>

                <div class="panel <?= $panel; ?> showControls">
                    <div class="panel-heading ui-draggable-handle">
                        <h3 class="panel-title"><?= $author; ?></h3>
                        <div class="panel-controls panel-controls-show">
                            <a href="javascript: void();"><?= date("d M Y, H:i", $message->date); ?></a>
                        </div>
                    </div> 
                    <div class="panel-body">
                        <?= $message->text; ?>
                    </div> 
                </div>

                <?php
            }
            ?>

        </div>
    </div>

    <div class="col-md-4 email-list" id="email-content">
        <?php echo $this->renderPartial('_list_tickets', array('dataProvider' => $dataProvider)); ?>
    </div>
</div>
