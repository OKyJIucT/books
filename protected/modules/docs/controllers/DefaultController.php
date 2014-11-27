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
                'actions' => array('index', 'view', 'create'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'update'),
                'roles' => array('administrator'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->pageTitle = 'Список документов';
        $dataProvider = new CActiveDataProvider(Docs::model()->with('user')->cache(60 * 15, new Tags('docsList'), 2));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $model = $this->loadModel($id);
        
        $this->pageTitle = $model->title;

        $this->render('view', array(
            'model' => $model
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $this->pageTitle = 'Добавление документа';

        $model = new Docs;

        $this->performAjaxValidation($model);

        if (isset($_POST['Docs'])) {
            $model->attributes = $_POST['Docs'];
            $model->date = time();
            $model->user_id = Yii::app()->user->id;

            $thumbs = CUploadedFile::getInstancesByName('thumb');
            if (isset($thumbs) && count($thumbs) > 0) {
                // go through each uploaded image
                foreach ($thumbs as $thumb => $file) {
                    $ext = array_pop(explode('.', $file->name));
                    $name = md5($file->name . time() . rand(100000, 9999999) . date("r", (time() - rand(100000, 9999999))));
                    if ($file->saveAs(Y::getDir(false, 'thumbs') . $name . '.' . $ext)) {
                        $model->thumb = $name . '.' . $ext;
                    }
                }
            }

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Docs'])) {
            $model->attributes = $_POST['Docs'];
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
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // очищаем кеш по документам
        C::clear('docsList');

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Docs('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Docs']))
            $model->attributes = $_GET['Docs'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Docs the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Docs::model()->with('user', 'chapters')->findByPk($id);
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Docs $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'docs-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
