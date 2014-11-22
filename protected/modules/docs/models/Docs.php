<?php

/**
 * This is the model class for table "docs".
 *
 * The followings are the available columns in table 'docs':
 * @property integer $id
 * @property string $title
 * @property string $title_en
 * @property string $thumb
 * @property string $text
 * @property integer $user_id
 * @property integer $date
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Docs extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'docs';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, title_en, author, text, user_id, date', 'required'),
            array('user_id, date', 'numerical', 'integerOnly' => true),
            array('title, title_en, author', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, title_en, author, thumb, text, user_id, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'chapters' => array(self::HAS_MANY, 'Chapter', 'docs_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'parts' => array(self::HAS_MANY, 'Parts', 'docs_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Название документа',
            'title_en' => 'Оригинальное название',
            'author' => 'Автор',
            'thumb' => 'Обложка',
            'text' => 'Краткое описание',
            'user_id' => 'Автор',
            'date' => 'Дата создания',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('title_en', $this->title_en, true);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('thumb', $this->thumb, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('date', $this->date);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Docs the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getDoc($id) {
        $cacheId = C::prefix('docs', $id);

        $model = C::get($cacheId);
        if ($model === false) {
            $model = Docs::model()->with('user')->findByPk($id);

            if (!$model)
                Y::error(404);

            C::set($cacheId, $model);
        }

        return $model;
    }

    /**
     * Количество документов для перевода
     * @return type
     */
    public static function countDocs() {
        $cacheId = C::prefix('countDocs');

        $count = C::get($cacheId);
        if ($count === false) {
            $count = Docs::model()->count();
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
            C::delete(C::prefix('countDocs'));
        } else {
            C::delete(C::prefix('docs', $this->id));
        }
        return parent::afterSave();
    }

}
