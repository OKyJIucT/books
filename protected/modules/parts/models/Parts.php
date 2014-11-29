<?php

/**
 * This is the model class for table "parts".
 *
 * The followings are the available columns in table 'parts':
 * @property integer $id
 * @property integer $docs_id
 * @property integer $chapter_id
 * @property integer $user_id
 * @property string $text
 * @property integer $date
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Docs $docs
 * @property Chapter $chapter
 */
class Parts extends CActiveRecord {

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
        return 'parts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('docs_id, chapter_id, user_id, text, date', 'required'),
            array('docs_id, chapter_id, user_id, date', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, docs_id, chapter_id, user_id, text, date', 'safe', 'on' => 'search'),
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
            'docs' => array(self::BELONGS_TO, 'Docs', 'docs_id'),
            'chapter' => array(self::BELONGS_TO, 'Chapter', 'chapter_id'),
            'versions' => array(self::HAS_MANY, 'Version', 'part_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'docs_id' => 'Docs',
            'chapter_id' => 'Chapter',
            'user_id' => 'User',
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
        $criteria->compare('docs_id', $this->docs_id);
        $criteria->compare('chapter_id', $this->chapter_id);
        $criteria->compare('user_id', $this->user_id);
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
     * @return Parts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
