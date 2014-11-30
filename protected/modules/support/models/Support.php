<?php

/**
 * This is the model class for table "support".
 *
 * The followings are the available columns in table 'support':
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property string $status
 * @property integer $create
 * @property integer $last_update
 * @property string $user_read
 * @property string $support_read
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property SupportMsg[] $supportMsgs
 */
class Support extends CActiveRecord {

    public $text;

    public function behaviors() {
        return array(
            'PurifyText' => array(
                'class' => 'DPurifyTextBehavior',
                'sourceAttribute' => 'name',
                'destinationAttribute' => 'name',
                // 'enableMarkdown'=>true,
                'purifierOptions' => array(
                    'AutoFormat.RemoveEmpty' => true,
                    'HTML.Allowed' => 'p',
                    'Core.EscapeInvalidTags' => true,
                ),
            ),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'support';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, user_id, status, create, last_update, user_read, support_read', 'required'),
            array('user_id, create, last_update', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            array('status, user_read, support_read', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, user_id, status, create, last_update, user_read, support_read', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'supportMsgs' => array(self::HAS_MANY, 'SupportMsg', 'support_id', 'order' => 'date DESC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Тема запроса в поддержку',
            'user_id' => 'User',
            'status' => 'Status',
            'create' => 'Create',
            'last_update' => 'Last Update',
            'user_read' => 'Read',
            'support_read' => 'Support Read',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create', $this->create);
        $criteria->compare('last_update', $this->last_update);
        $criteria->compare('user_read', $this->user_read, true);
        $criteria->compare('support_read', $this->support_read, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Support the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Очищаем кеш после каждого добавления
     * @return type
     */
    public function afterSave() {
        C::delete(C::prefix('countTicketsSupport'));
        C::clear('ticketUser_' . $this->user_id);
        return parent::afterSave();
    }

}
