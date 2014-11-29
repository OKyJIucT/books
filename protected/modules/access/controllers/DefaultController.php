<?php

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('getAccess', 'index', 'changeAccess'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array('administrator'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetAccess() {
        if (Y::isAjaxRequest()) {
            $docs_id = intval($_POST['docs_id']);
            $docs = Docs::model()->findByPk($docs_id);

            $user_id = Yii::app()->user->id;

            $criteria = new CDbCriteria();
            $criteria->condition = 'user_id = :user_id AND docs_id = :docs_id';
            $criteria->params = array(':user_id' => $user_id, 'docs_id' => $docs_id);

            $exist = Access::model()->exists($criteria);

            if (!$exist) {
                $access = new Access();
                $access->user_id = $user_id;
                $access->docs_id = $docs_id;
                $access->role = 5;

                if ($access->save()) {
                    $message = '<p>Привет!</p><p>Пользователь <strong>' . Yii::app()->user->name . '</strong> запросил доступ к документу <a href=" ' . Y::url('/docs/default/view', array('id' => $docs->id)) . '" target="_blank">' . $docs->title . '</a></p>';
                    echo Y::sendMail($docs->user->email, 'Запрос на доступ к документу', $message);
                }
            }
        }
    }

    public function actionChangeAccess() {
        if (Y::isAjaxRequest()) {

            $docs_id = intval($_POST['docs_id']);
            $user_id = intval($_POST['user_id']);

            $criteria = new CDbCriteria();
            $criteria->condition = 'user_id = :user_id AND docs_id = :docs_id';
            $criteria->params = array(':user_id' => $user_id, 'docs_id' => $docs_id);
            $criteria->select = 'role';

            $access = Access::model()->find($criteria);

            $docs = Docs::model()->findByPk($docs_id);

            if ($docs->user_id == Yii::app()->user->id || Y::hasAccess('administrator')) {
                $criteria = new CDbCriteria();
                $criteria->condition = 'docs_id = :docs_id AND user_id = :user_id';
                $criteria->params = array(':docs_id' => $docs->id, ':user_id' => $user_id);
                $attributes = array(
                    'role' => $access->role == 5 ? 3 : 5
                );

                Access::model()->updateAll($attributes, $criteria);

                echo 'success';
            } else
                echo 'error';
        }
    }

}
