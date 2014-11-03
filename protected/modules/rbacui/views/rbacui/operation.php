<?php
/* @var array $operations[] CAuthItem */

$keys = array_keys($operations);
sort($keys);
$options = (count($keys) > 0) ? array_combine($keys, $keys) : array();
?>
<div class="row">
    <div class="col-lg-12" style="display:inline-block">
        <div class="row">
            <div class="col-lg-2">
                <?php echo CHtml::dropDownList('operation', '', $options, array('size' => 14, 'style' => 'width:148px;', 'onchange' => 'selectAuthItem(this,"' . $this->createAbsoluteUrl('ajax/infoAuthItem') . '");')); ?>
            </div>
            <div class="col-lg-8" id="operation-info"><hr></div>
            <div class="col-lg-2">
                <?php
                if ($this->isAdmin()):
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Новая операцию'), array('onclick' => 'openDialogCreate(0);'));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Изменить операцию'), array('onclick' => 'openDialogChange(0,"' . $this->createAbsoluteUrl('ajax/getAuthItem') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить операцию'), array('onclick' => 'deleteAuthItem(0,"' . $this->createAbsoluteUrl('ajax/deleteAuthItem') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Создать дочернюю'), array('onclick' => 'openDialogAttach(0,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить дочернюю'), array('onclick' => 'openDialogDetach(0,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                endif;
                ?>
            </div>
        </div>
    </div>
</div>