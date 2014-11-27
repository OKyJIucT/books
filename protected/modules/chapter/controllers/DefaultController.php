<?php

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

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
                'actions' => array('index', 'view', 'create', 'update'),
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

    /**
     * Lists all models.
     */
    public function actionIndex() {
        Y::redir(array('/docs'));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $array = array(
            'criteria' => array(
                'condition' => 'chapter_id = :chapter_id',
                'params' => array(':chapter_id' => $id)
            ),
            'pagination' => array(
                'pageSize' => 10,
            )
        );

        $dataProvider = new CActiveDataProvider(Parts::model()->with('docs', 'chapter')->cache(60 * 15, new Tags('partsList', 'part_' . $id), 2), $array);

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $this->pageTitle = 'Добавление главы';

        $id = intval(Yii::app()->request->getParam('docs'));

        $doc = Docs::getDoc($id);

        $model = new Chapter;

        $this->performAjaxValidation($model);

        if (isset($_POST['Chapter'])) {

            $model->attributes = $_POST['Chapter'];
            $model->docs_id = $doc->id;
            $model->user_id = Yii::app()->user->id;
            $model->date = time();

            $thumbs = CUploadedFile::getInstancesByName('text');
            if (isset($thumbs) && count($thumbs) > 0) {
                // go through each uploaded image
                foreach ($thumbs as $thumb => $file) {
                    $ext = array_pop(explode('.', $file->name));
                    $name = md5($file->name . time() . rand(100000, 9999999) . date("r", (time() - rand(100000, 9999999))));
                    if ($file->saveAs(Y::getDir(false, 'documents') . $name . '.' . $ext)) {
                        $model->path = $name . '.' . $ext;
                    }
                }
            }

            if ($model->save()) {
                C::clear('doc_' . $id);
                $this->redirect(array('/chapter/default/update', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'doc' => $doc
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

        if (isset($_POST['Chapter'])) {

            $str = strip_tags(htmlspecialchars_decode($_POST['Chapter']['text']), '<p><hr>');
            $str = str_replace("<p></p>", "", $str);
            $parts = explode("<hr>", $str);

            foreach ($parts as $item) {
                if (empty($item))
                    continue;

                $part = new Parts();
                $part->docs_id = $model->docs->id;
                $part->chapter_id = $model->id;
                $part->user_id = Yii::app()->user->id;
                $part->date = time();
                $part->hash = Y::getHash();
                $part->text = $item;

                $part->save();
            }

            $model->attributes = $_POST['Chapter'];
            if ($model->save()) {
                $cacheId = C::prefix('chapters', $id);
                C::delete($cacheId);
                $this->redirect(array('view', 'id' => $model->id));
            }
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
        C::clear('chapter_' . $id);
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Chapter('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Chapter']))
            $model->attributes = $_GET['Chapter'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Chapter the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {

        $cacheId = C::prefix('chapters', $id);

        $model = C::get($cacheId);
        if ($model === false) {
            $model = Chapter::model()->with('docs')->findByPk($id);

            if (!$model)
                Y::error(404);

            C::set($cacheId, $model, '', new Tags('chapterItem', 'chapter_' . $id));
        }

        return $model;

        $model = Chapter::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Chapter $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'chapter-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
