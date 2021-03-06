<?php

class SubscriberController extends BackEndController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    protected function beforeAction($action) {
        $access = $this->checkAccess(Yii::app()->controller->id, Yii::app()->controller->action->id);
        if ($access == 1) {
            return true;
        } else {
            Yii::app()->user->setFlash('error', "You are not authorized to perform this action!");
            $this->redirect(array('/site/noaccess'));
        }
    }

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'synchronize'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    /**
     * Synchronize user from user table
     */
    public function actionSynchronize() {
    	Yii::app()->db->createCommand('SET SESSION group_concat_max_len = 1000000')->execute();
    	//get all users
    	$users = User::model()->findAll();
    	//import from user table
    	foreach ($users as $key=>$value){
    		//check this user already exist or not
    		if (($model = Subscriber::model()->find(array('condition' => 'email="' . trim($value['email']) . '"'))) === null){
    			$model = new Subscriber;
                        $model->groups = 1;
    			$model->full_name = trim($value['name']);
    			$model->email = trim($value['email']);
    			$model->created_on = new CDbExpression('NOW()');
    			$model->confirmed = 1;
    			$model->enabled = 1;
    			$model->save();
    		}
    	}
    	Yii::app()->user->setFlash('success', 'Subscriber has been Synchronized successfully!');
    	$this->redirect(array('admin'));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Subscriber;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Subscriber'])) {
            $model->attributes = $_POST['Subscriber'];
            //save groups
            if (is_array(@$_POST['Subscriber']['groups']))
            	$model->groups = implode(",", $model->attributes['groups']);
            
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Subscriber has been created successfully');
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Subscriber'])) {
            $model->attributes = $_POST['Subscriber'];
            //save groups
            if (is_array(@$_POST['Subscriber']['groups']))
            	$model->groups = implode(",", $model->attributes['groups']);
            
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Subscriber has been updated successfully');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        
        if (isset($model->groups))
        	$model->groups = explode(',', $model->groups);

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
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Subscriber');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Subscriber('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Subscriber']))
            $model->attributes = $_GET['Subscriber'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Subscriber::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'subscriber-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
