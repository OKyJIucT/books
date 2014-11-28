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
                'actions' => array('SaveTranslate', 'index'),
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
        Y::redir(array('/docs'));
    }

    public function actionSaveTranslate() {
        if (Y::isAjaxRequest()) {

            $part_id = intval($_POST['part_id']);
         
            $text = strip_tags(array_shift($_POST['translate']), '<p>');

            if (Version::partExist(Yii::app()->user->id, $part_id)) {
                $criteria = new CDbCriteria();
                $criteria->condition = 'user_id = :user_id AND part_id = :part_id';
                $criteria->params = array(':user_id' => Yii::app()->user->id, ':part_id' => $part_id);
                $attributes = array('text' => $text);
                
                Version::model()->updateAll($attributes, $criteria);
            } else {
                $version = new Version();
                $version->text = $text;
                $version->user_id = Yii::app()->user->id;
                $version->date = time();
                $version->part_id = $part_id;
                $version->hash = Y::getHash();
                $version->save();
            }
            
            $criteria = new CDbCriteria();
            $criteria->condition = 'id = :id';
            $criteria->params = array(':id' => $part_id);

            $parts = Parts::model()->find($criteria);
            
            C::clear('chapter_' . $parts->chapter_id);

            echo CHtml::encode('Сохранено');
            // Завершаем приложение
            Yii::app()->end();
        }
    }

}
