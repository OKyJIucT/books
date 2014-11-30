<?php
/* @var array $tasks[] CAuthItem */

$keys = array_keys($tasks);
sort($keys);
$options = (count($keys) > 0) ? array_combine($keys, $keys) : array();
?>
<div class="row">
    <div class="col-md-12" style="display:inline-block">
        <div class="row">
            <div class="col-md-2">
                <?php echo CHtml::dropDownList('task', '', $options, array('size' => 14, 'style' => 'width:148px;', 'onchange' => 'selectAuthItem(this,"' . $this->createAbsoluteUrl('ajax/infoAuthItem') . '");')); ?>
            </div>
            <div class="col-md-8" id="task-info"><hr></div>
            <div class="col-md-2">
                <?php
                if ($this->isAdmin()):
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Новая задача'), array('onclick' => 'openDialogCreate(1);'));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Изменить задачу'), array('onclick' => 'openDialogChange(1,"' . $this->createAbsoluteUrl('ajax/getAuthItem') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить задачу'), array('onclick' => 'deleteAuthItem(1,"' . $this->createAbsoluteUrl('ajax/deleteAuthItem') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Создать дочернюю'), array('onclick' => 'openDialogAttach(1,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить дочернюю'), array('onclick' => 'openDialogDetach(1,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Добавить операцию'), array('onclick' => 'openDialogAttach(1,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить операцию'), array('onclick' => 'openDialogDetach(1,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                endif;
                ?>
            </div>
        </div>
    </div>
</div>