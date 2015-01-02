<?php

/**
 * This is the model class for table "invites".
 *
 * The followings are the available columns in table 'invites':
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Invites extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'invites';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, code', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('code', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, code', 'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'code' => 'Code',
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('code', $this->code, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Invites the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Генерация инвайтов
     * @param type $user_id
     * @param type $count
     */
    public static function generateInvite($user_id, $count = 1)
    {
        $arr = array('a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0');

        // Генерируем и сохраняем код приглашения
        for ($c = 1; $c <= $count; $c++) {
            $code = '';
            for ($i = 0; $i < 32; $i++) {
                // Вычисляем случайный индекс массива
                $index = rand(0, count($arr) - 1);
                $code .= $arr[$index];
            }

            $invite = new Invites();
            $invite->user_id = $user_id;
            $invite->code = $code;
            $invite->save();
        }
    }

    public static function changeInvite($code)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'code = :code';
        $criteria->params = array(':code' => $code);

        $invite = Invites::model()->find($criteria);

        if ($invite->user_id == Yii::app()->user->id) {
            $invite->hold = time() + 86400;
            $invite->save();

            // чистим кеш профиля приглащаюшего
            C::delete(C::prefix('profile', $invite->user_id));
        }
    }

}
