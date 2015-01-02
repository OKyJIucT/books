<?php

/**
 * This is the model class for table "chapter".
 *
 * The followings are the available columns in table 'chapter':
 * @property integer $id
 * @property integer $docs_id
 * @property string $name
 * @property string $name_en
 * @property integer $user_id
 * @property integer $date
 *
 * The followings are the available model relations:
 * @property Docs $docs
 * @property Users $user
 */
class Chapter extends CActiveRecord
{

    public function behaviors()
    {
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

    public $text;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'chapter';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('docs_id, name, name_en, user_id, date', 'required'),
            array('docs_id, user_id, date', 'numerical', 'integerOnly' => true),
            array('name, name_en', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, docs_id, name, name_en, path, user_id, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'docs' => array(self::BELONGS_TO, 'Docs', 'docs_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'parts' => array(self::HAS_MANY, 'Parts', 'chapter_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID документа',
            'docs_id' => 'Docs',
            'name' => 'Название главы',
            'name_en' => 'Оригинальное название',
            'text' => 'TXT файл с главой',
            'user_id' => 'ID пользователя',
            'date' => 'Дата добавления',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('docs_id', $this->docs_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('name_en', $this->name_en, true);
        $criteria->compare('path', $this->path, true);
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
     * @return Chapter the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}
