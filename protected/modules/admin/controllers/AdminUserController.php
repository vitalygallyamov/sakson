<?php

class AdminUserController extends AdminController
{
    public $layout = '/layouts/custom';

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('create', 'update', 'list'),
                'roles'=>array('admin'),
            ),
            array('allow',
                'actions'=>array('update'),
                'roles'=>array('agent'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionCreate(){
        $model = new AdminUser;

        if(isset($_POST['AdminUser'])){
            $model->attributes = $_POST['AdminUser'];

            if(isset($_POST['role'])){
                $model->role = $_POST['role'];
            }

            if($model->validate()){
                Yii::app()->swiftmail->sendEmail("test@test.com", $model->email, 'Доступы в систему управления объектами недвижимости', $this->renderPartial('_email', array('model' => $model), true));
                $model->save(false);
                $this->redirect($this->createUrl('list'));
            }
        }

        $model->pass = '';

        $this->render('create', array(
            'model' => $model
        ));
    }

    public function actionUpdate($id){
        $model = AdminUser::model()->findByPk($id);

        if(!Yii::app()->user->checkAccess('admin') && Yii::app()->user->id != $model->id){
             throw new CHttpException(403, 'Ошибка доступа');
        }

        if(isset($_POST['AdminUser'])){
            $model->attributes = $_POST['AdminUser'];

            if(isset($_POST['role'])){
                $model->role = $_POST['role'];
            }

            if($model->save())
                $this->redirect($this->createUrl('list'));
        }

        $model->pass = '';

        $this->render('update', array(
            'model' => $model
        ));
    }

	/*public function actionList(){
        print_r($this->getAction()->getModelName()); die();

		$model = new AdminUser('search');
        
        if(isset($_GET['AdminUser']))
            $model->attributes = $_GET['AdminUser'];
        
        $this->render('list', array(
            'model' => $model,
        ));
	}

    public function beforeAction($action){

        print_r($action);

        return parent::beforeAction($action);
    }*/
	/*public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
            	'actions' => array('list'),
            	'users'=>array('*'),
                // 'roles'=>array('admin'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }*/
}