<?php

class SiteController extends Controller {

    public $layout = 'main';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('login', 'reg', 'error'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('index', 'profile', 'logout', 'editInvite'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('clearCache', 'getInvites'),
                'roles' => array('administrator'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->pageTitle = 'Главная';

        //Y::dump(Y::sendMail('okyjiuct@gmail.com', 'С Днем Рождения!', 'Желаю счестья в личной жизни! :)'), false);

        $this->render('index');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = 'no_auth';
        $this->pageTitle = 'Авторизация';

        $model = new LoginForm;
        $model->scenario = 'auth';

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->render('login', array('model' => $model));
    }

    /**
     * Регистрация юзеров
     */
    public function actionReg() {
        $this->layout = 'no_auth';
        $this->pageTitle = 'Регистрация';

        $model = new Users;
        $model->scenario = 'reg';

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Users'])) {

            $model->attributes = $_POST['Users'];
            $model->reg_date = time();
            $model->password = Users::cryptPass($_POST['Users']['password']);

            if ($model->save() && $model->validate()) {

                $auth = new LoginForm;
                $auth->attributes = $_POST['Users'];

                Y::sendMail($_POST['Users']['email'], 'Регистрация на сайте Bookswood.ru', '<p>Поздравляем с регистрацией, ' . $_POST['Users']['username'] . '!</p> <p>При возникновении вопросов обращайтесь, пожалуйста, в службу поддержки.</p>');

                if ($auth->validate() && $auth->login())
                    $this->redirect('/');
            }

            $model->password = $_POST['Users']['password'];
        }

        $this->render('reg', array(
            'model' => $model,
                )
        );
    }

    /**
     * Профиль пользователя
     * @param type $id
     */
    public function actionProfile($id) {

        $profile = Users::getProfile($id);

        $this->pageTitle = 'Профиль ' . $profile->username;

        $this->render('profile', array(
            'profile' => $profile,
                )
        );
    }

    public function actionEditInvite() {
        if (Y::isAjaxRequest()) {
            Invites::changeInvite($_POST['code']);
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {

        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {

        if (Y::isGuest())
            $this->layout = 'no_auth';

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else {
                $this->pageTitle = $error['message'];
                $this->render('error', $error);
            }
        }
    }

    /**
     * Очистка всего кеша
     */
    public function actionClearCache() {
        C::flush();
        $this->redirect(Yii::app()->user->returnUrl);
    }

    /**
     * Генерация инвайтов
     */
    public function actionGetInvites() {
        Invites::generateInvite(1, 5);
        C::delete(C::prefix('profile', 1));
        $this->redirect(Yii::app()->user->returnUrl);
    }

}
