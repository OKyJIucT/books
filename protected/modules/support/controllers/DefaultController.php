<?php

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

class DefaultController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
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
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {

        $id = intval($id);

        if (isset($_POST['Support'])) {
            $msg = new SupportMsg();
            $msg->user_id = Yii::app()->user->id;
            $msg->support_id = $id;
            $msg->text = $_POST['Support']['text'];
            $msg->date = time();

            if ($msg->save()) {

                if (Y::hasAccess('administrator')) {
                    $attributes = array(
                        'last_update' => time(),
                        'user_read' => 0
                    );
                } else {
                    $attributes = array(
                        'last_update' => time(),
                        'support_read' => 0
                    );
                }

                $criteria = new CDbCriteria();
                $criteria->condition = 'id = :id';
                $criteria->params = array(':id' => $id);

                Support::model()->updateAll($attributes, $criteria);

                $this->redirect(array('view', 'id' => $id));
            }
        }

        if (Y::hasAccess('administrator')) {
            $attributes = array(
                'support_read' => 1
            );
        } else {
            $attributes = array(
                'user_read' => 1
            );
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'id = :id';
        $criteria->params = array(':id' => $id);

        Support::model()->updateAll($attributes, $criteria);

        if (Y::hasAccess('administrator')) {
            $array = array(
                'criteria' => array(
                    'order' => 'last_update DESC'
                ),
                'pagination' => array(
                    'pageSize' => 10,
                )
            );
        } else {
            $array = array(
                'criteria' => array(
                    'condition' => 'user_id = :user_id',
                    'params' => array(':user_id' => Yii::app()->user->id),
                    'order' => 'last_update DESC'
                ),
                'pagination' => array(
                    'pageSize' => 10,
                )
            );
        }

        $dataProvider = new CActiveDataProvider('Support', $array);

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'dataProvider' => $dataProvider
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {

        $model = new Support;

        $this->performAjaxValidation($model);

        if (isset($_POST['Support'])) {
            $model->attributes = $_POST['Support'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Support'])) {
            $model->attributes = $_POST['Support'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {

        if (Y::hasAccess('administrator')) {
            $array = array(
                'criteria' => array(
                    'order' => 'last_update DESC'
                ),
                'pagination' => array(
                    'pageSize' => 10,
                )
            );
        } else {
            $array = array(
                'criteria' => array(
                    'condition' => 'user_id = :user_id',
                    'params' => array(':user_id' => Yii::app()->user->id),
                    'order' => 'last_update DESC'
                ),
                'pagination' => array(
                    'pageSize' => 10,
                )
            );
        }

        $dataProvider = new CActiveDataProvider('Support', $array);

        $model = new Support;

        $this->performAjaxValidation($model);

        if (isset($_POST['Support'])) {
            $model->name = $_POST['Support']['name'];
            $model->user_id = Yii::app()->user->id;
            $model->status = 1;
            $model->create = time();
            $model->last_update = time();
            $model->user_read = 1;
            $model->support_read = 0;


            if ($model->save()) {

                $msg = new SupportMsg();
                $msg->user_id = Yii::app()->user->id;
                $msg->support_id = $model->id;
                $msg->text = $_POST['Support']['text'];
                $msg->date = time();

                if ($msg->save())
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Support('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Support']))
            $model->attributes = $_GET['Support'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Support the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Support::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Support $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'support-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
