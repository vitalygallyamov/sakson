<?php

class AdminUserController extends AdminController
{
    /*public function init(){
        parent::init();

        // $this->modelName = 'AdminUser';
    }*/

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                // 'actions' => array('list', 'create', 'update', ''),
                'roles'=>array('admin'),
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

            if($model->save())
                $this->redirect($this->createUrl('list'));
        }

        $model->pass = '';

        $this->render('create', array(
            'model' => $model
        ));
    }

    public function actionUpdate($id){
        $model = AdminUser::model()->findByPk($id);

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
