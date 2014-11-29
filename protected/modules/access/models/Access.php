<?php

/**
 * This is the model class for table "access".
 *
 * The followings are the available columns in table 'access':
 * @property integer $id
 * @property integer $user_id
 * @property integer $docs_id
 * @property integer $role
 *
 * The followings are the available model relations:
 * @property Docs $docs
 * @property Users $user
 */
class Access extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'access';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, docs_id, role', 'required'),
            array('user_id, docs_id, role', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, docs_id, role', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'docs' => array(self::BELONGS_TO, 'Docs', 'docs_id'),
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
            'docs_id' => 'Docs',
            'role' => 'Role',
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
        $criteria->compare('docs_id', $this->docs_id);
        $criteria->compare('role', $this->role);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Access the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Проверка доступа к документу
     * 1 - владелец
     * 2 - редактор
     * 3 - переводчик
     * 4 - публичный доступ
     * 5 - доступ запрещен
     * @param type $user_id
     * @param type $docs_id
     * @return int
     */
    public static function check($user_id, $docs_id) {

        $docs = Docs::model()->findByPk($docs_id);
        if ($docs->type == '0') {
            return array(
                'exist' => true,
                'role' => 4
            );
        }

        if (Y::hasAccess('administrator'))
            return array(
                'exist' => true,
                'role' => 1
            );

        $criteria = new CDbCriteria();
        $criteria->condition = 'user_id = :user_id AND docs_id = :docs_id';
        $criteria->params = array(':user_id' => $user_id, 'docs_id' => $docs_id);
        $criteria->select = 'role';

        $access = Access::model()->find($criteria);

        if ($access != null) {
            return array(
                'exist' => true,
                'role' => $access->role
            );
        } else {
            return array(
                'exist' => false,
                'role' => $access->role
            );
        }
    }

}
