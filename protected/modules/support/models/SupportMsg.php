<?php

/**
 * This is the model class for table "support_msg".
 *
 * The followings are the available columns in table 'support_msg':
 * @property integer $id
 * @property integer $user_id
 * @property integer $support_id
 * @property string $text
 * @property integer $date
 *
 * The followings are the available model relations:
 * @property Support $support
 * @property Users $user
 */
class SupportMsg extends CActiveRecord {

    public function behaviors() {
        return array(
            'PurifyText' => array(
                'class' => 'DPurifyTextBehavior',
                'sourceAttribute' => 'text',
                'destinationAttribute' => 'text',
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
        return 'support_msg';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, support_id, text, date', 'required'),
            array('user_id, support_id, date', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, support_id, text, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'support' => array(self::BELONGS_TO, 'Support', 'support_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'support_id' => 'Support',
            'text' => 'Text',
            'date' => 'Date',
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('support_id', $this->support_id);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('date', $this->date);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SupportMsg the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
