﻿<?php
/* @var $this RbacuiController */
/* @array $users[] User */
?>
<div class="row">
    <div class="col-md-12" style="display:inline-block">
        <div class="row">
            <div class="col-md-3">
                <table style="margin-bottom:0;">
                    <tr>
                        <td>
                            <?php echo CHtml::textField('search', '', array('style' => 'width:215px;')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form id="user-select-form">
                                <?php echo CHtml::dropDownList('user[]', '', CHtml::listData($users, $this->module->userIdColumn, $this->module->userNameColumn), array('onchange' => 'selectUser("' . $this->createAbsoluteUrl('ajax/infoUserAssignments') . '");', 'multiple' => true, 'size' => '20', 'style' => 'width:220px;'));
                                ?>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-7" id="user-info">
                <hr>
            </div>
            <div class="col-md-2">
                <?php
                echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Привязать роль'), array('onclick' => 'openDialogAssign(2,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
                echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Отвязать роль'), array('onclick' => 'openDialogRevoke(2,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
                if ($this->isAdmin() || $this->isAssign()):
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Привязать задачу'), array('onclick' => 'openDialogAssign(1,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Отвязать задачу'), array('onclick' => 'openDialogRevoke(1,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Привязать операцию'), array('onclick' => 'openDialogAssign(0,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
                    echo CHtml::button(Yii::t('RbacuiModule.rbacui', 'Отвязать операцию'), array('onclick' => 'openDialogRevoke(0,"' . $this->createAbsoluteUrl('ajax/itemTypeList') . '");', 'disabled' => true));
                endif;
                ?>
            </div>
        </div>
    </div>
</div>