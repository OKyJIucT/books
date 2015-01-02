<?php

/**
 * AuthItemForm class.
 * AuthItemForm is the data structure for authorization item form data.
 * It is used for the creation of CAuthManager authorization items.
 */
class AuthItemForm extends CFormModel
{

    public $name;
    public $oldname;
    public $type;
    public $description;
    public $bizRule;
    public $data;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('name, type', 'required'),
            array('type', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 2),
            array('bizRule, data', 'default', 'value' => null),
            array('oldname, description', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'name' => Yii::t('RbacuiModule.rbacui', 'Имя'),
            'type' => Yii::t('RbacuiModule.rbacui', 'Тип'),
            'description' => Yii::t('RbacuiModule.rbacui', 'Описание'),
            'bizRule' => Yii::t('RbacuiModule.rbacui', 'Правило'),
            'data' => Yii::t('RbacuiModule.rbacui', 'Данные'),
        );
    }

}
