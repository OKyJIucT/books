<?php
/* @var $this SupportController */
/* @var $model Support */

$this->breadcrumbs = array(
    'Служба поддержки' => array('index'),
    '#' . $model->id . ' ' . $model->name,
);
?>

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
            <div class="col-md-10">
                <h3><?php echo $model->name; ?></h3>
            </div>
            <div class="col-md-2control-label ">
                <?php
                echo CHtml::htmlButton('Добавить ответ', array(
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

            <div class="panel <?= $panel; ?>">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title"><?= $author; ?></h3>
                    <ul class="panel-controls">
                        <li class="mtop"><?= date("d M Y, H:i", $message->date); ?></li>
                    </ul>
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

<div class="col-md-4">
    <?php echo $this->renderPartial('_list_tickets', array('dataProvider' => $dataProvider)); ?>
</div>