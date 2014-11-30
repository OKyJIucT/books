<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $email
 * @property string $pass
 * @property string $username
 * @property integer $reg_date
 * @property integer $last_visit
 * @property integer $role
 */
class Users extends CActiveRecord {

    public $invite;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            /* auth */
            array('email', 'required', 'message' => 'Не заполнено поле Email', 'on' => 'auth'),
            array('password', 'required', 'message' => 'Не заполнено поле Пароль', 'on' => 'auth'),
            /* auth */

            /* reg */
            array('email', 'required', 'message' => 'Не заполнено поле Email', 'on' => 'reg'),
            array('email', 'email', 'message' => 'Введите корректный Email', 'on' => 'reg'),
            array('email', 'unique', 'message' => 'Этот Email уже используется', 'on' => 'reg'),
            array('username', 'required', 'message' => 'Не заполнено поле Логин', 'on' => 'reg'),
            array('username', 'unique', 'message' => 'Этот Логин уже используется', 'on' => 'reg'),
            array('password', 'required', 'message' => 'Не заполнено поле Пароль', 'on' => 'reg'),
            array('password, username', 'length', 'min' => 5, 'on' => 'reg'),
            array('email, username', 'length', 'max' => 32, 'on' => 'reg'),
            array('password', 'length', 'max' => 255, 'on' => 'reg'),
            array('invite', 'required', 'message' => 'Не заполнено поле Код приглашения', 'on' => 'reg'),
            array('invite', 'exist', 'message' => 'Неверный код приглашения', 'attributeName' => 'code', 'className' => 'Invites', 'on' => 'reg'),
            array('reg_date', 'required', 'on' => 'reg'),
            array('reg_date, ref_id', 'numerical', 'integerOnly' => true, 'on' => 'reg'),
            /* reg */

            /* search */
            array('id, email, password, username, reg_date, ref_id', 'safe', 'on' => 'search'),
                /* search */
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'accesses' => array(self::HAS_MANY, 'Access', 'user_id'),
            'chapters' => array(self::HAS_MANY, 'Chapter', 'user_id'),
            'docs' => array(self::HAS_MANY, 'Docs', 'user_id'),
            'invites' => array(self::HAS_MANY, 'Invites', 'user_id'),
            'parts' => array(self::HAS_MANY, 'Parts', 'user_id'),
            'supports' => array(self::HAS_MANY, 'Support', 'user_id'),
            'supportMsgs' => array(self::HAS_MANY, 'SupportMsg', 'user_id'),
            'versions' => array(self::HAS_MANY, 'Version', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Пароль',
            'username' => 'Логин',
            'reg_date' => 'Дата регистрации',
            'last_visit' => 'Последняя активность',
            'ref_id' => 'Пригласивший',
            'invite' => 'Код приглашения',
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
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('reg_date', $this->reg_date);
        $criteria->compare('ref_id', $this->ref_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Хеширование пароля
     * @param type $password
     * @return type
     */
    public static function cryptPass($password) {
        return crypt($password);
    }

    /**
     * Отправка запроса о том, что юзер находится онлайн
     */
    public static function setOnline() {

        $criteria = new CDbCriteria();
        $criteria->condition = 'id = :id';
        $criteria->params = array(':id' => Yii::app()->user->id);
        $attributes = array(
            'last_visit' => time()
        );
        Users::model()->updateAll($attributes, $criteria);
    }

    /**
     * Получение списка онлайн игроков
     * @return type
     */
    public static function whoOnline() {

        $criteria = new CDbCriteria();
        $criteria->condition = 'last_visit > :last_visit';
        $criteria->params = array(':last_visit' => time() - 60);
        $criteria->select = 'username';
        $criteria->order = 'username ASC';

        return Users::model()->findAll($criteria);
    }

    /**
     * Получение информации о пользователе
     * @param type $id
     * @return type
     */
    public static function getUser($id) {

        $cacheId = C::prefix('profile', $id);

        $profile = C::get($cacheId);
        if ($profile === false) {
            $profile = Users::model()->with('invites')->findByPk($id, array('select' => 'id, username, reg_date, email'));

            if (!$profile)
                Y::error(404);

            C::set($cacheId, $profile, 3600, new Tags('userItem', 'user_' . $id));
        }

        return $profile;
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'code = :code';
            $criteria->params = array(':code' => $this->invite);
            $criteria->limit = 1;
            $invite = Invites::model()->find($criteria);

            $this->ref_id = $invite->user_id;

            // чистим кеш профиля приглащаюшего
            C::delete(C::prefix('profile', $invite->user_id));

            // удаляем использованный инвайт
            $invite->delete();
        }
        return parent::beforeSave();
    }

    public function afterSave() {
        if ($this->isNewRecord) {
            Invites::generateInvite($this->id, 5);
        }
        return parent::afterSave();
    }

}
