<?php

/**
 * This is the model class for table "version".
 *
 * The followings are the available columns in table 'version':
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property integer $date
 * @property integer $version
 * @property integer $part_id
 * @property string $hash
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Parts $part
 */
class Version extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'version';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('text, user_id, date, version, part_id, hash', 'required'),
            array('user_id, date, version, part_id', 'numerical', 'integerOnly' => true),
            array('hash', 'length', 'max' => 8),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, text, user_id, date, version, part_id, hash', 'safe', 'on' => 'search'),
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
            'part' => array(self::BELONGS_TO, 'Parts', 'part_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User',
            'date' => 'Date',
            'version' => 'Version',
            'part_id' => 'Part',
            'hash' => 'Hash',
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
        $criteria->compare('text', $this->text, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('date', $this->date);
        $criteria->compare('version', $this->version);
        $criteria->compare('part_id', $this->part_id);
        $criteria->compare('hash', $this->hash, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Version the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
