<?php
/* @var array $roles[] CAuthItem */

$keys = array_keys($roles);
sort($keys);
$options = (count($keys) > 0) ? array_combine($keys, $keys) : array();
?>
<div class="row">
    <div class="col-lg-12" style="display:inline-block">
        <div class="row">
            <div class="col-lg-2">
                <?php echo CHtml::dropDownList('role', '', $options, array('size' => 14, 'style' => 'width:148px;', 'onchange' => 'selectAuthItem(this,"' . $this->createAbsoluteUrl('ajax/infoAuthItem') . '");')); ?>
            </div>
            <div class="col-lg-8" id="role-info"><hr></div>
            <div class="col-lg-2">
                <?php
                if ($this->isAdmin()):
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Новая роль'), array('id' => 'btnCreateRole', 'onclick' => 'openDialogCreate(2);'));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Изменить роль'), array('id' => 'btnChangeRole', 'onclick' => 'openDialogChange(2,"' . $this->createAbsoluteUrl('ajax/getAuthItem') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить роль'), array('onclick' => 'deleteAuthItem(2,"' . $this->createAbsoluteUrl('ajax/deleteAuthItem') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Добавить дочернюю'), array('onclick' => 'openDialogAttach(2,2,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить дочернюю'), array('onclick' => 'openDialogDetach(2,2,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Добавить задачу'), array('onclick' => 'openDialogAttach(2,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить задачу'), array('onclick' => 'openDialogDetach(2,1,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Добавить операцию'), array('onclick' => 'openDialogAttach(2,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Удалить операцию'), array('onclick' => 'openDialogDetach(2,0,"' . $this->createAbsoluteUrl('ajax/itemList') . '");', 'disabled' => true));
                endif;
                ?>
            </div>
        </div>
    </div>
</div>