<?php
/* @var $this PartsController */
/* @var $data Parts */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('docs_id')); ?>:</b>
    <?php echo CHtml::encode($data->docs_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('chapter_id')); ?>:</b>
    <?php echo CHtml::encode($data->chapter_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('version')); ?>:</b>
    <?php echo CHtml::encode($data->version); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
    <?php echo CHtml::encode($data->text); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
    <?php echo CHtml::encode($data->date); ?>
    <br/>


</div>