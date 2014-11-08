<?php

/**
 * This is the model class for table "translate".
 *
 * The followings are the available columns in table 'translate':
 * @property integer $id
 * @property string $name
 * @property string $en_name
 * @property integer $user_id
 * @property double $percent
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Translate extends CActiveRecord {

    public $file;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'translate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, en_name, user_id, date, type', 'required'),
            array('user_id, date', 'numerical', 'integerOnly' => true),
            array('percent', 'numerical'),
            array('name, en_name', 'length', 'max' => 255),
            array('type', 'length', 'max' => 16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, en_name, user_id, percent, date, type', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'en_name' => 'En Name',
            'user_id' => 'User',
            'percent' => 'Percent',
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
        $criteria->compare('en_name', $this->en_name, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('percent', $this->percent);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Translate the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    /**
     * Количество документов для перевода
     * @return type
     */
    public static function countTranslates() {
        $cacheId = C::prefix('countTranslate');

        $count = C::get($cacheId);
        if ($count === false) {
            $count = Translate::model()->count();
            C::set($cacheId, $count);
        }

        return $count ? $count : 0;
    }

    /**
     * Очищаем кеш после каждого добавления
     * @return type
     */
    public function afterSave() {
        if ($this->isNewRecord) {
            C::delete(C::prefix('countTranslate'));
        }
        return parent::afterSave();
    }

}
