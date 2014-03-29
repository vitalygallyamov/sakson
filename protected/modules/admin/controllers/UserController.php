<?php

class UserController extends AdminController
{
	public $defaultAction = 'index';

	public function accessRules()
    {
        return array(
        	array('allow', // allow authenticated users to access all actions
            	'actions' => array('profile'),
                'users'=>array('@'),
            ),
            array('allow', // allow authenticated users to access all actions
            	'actions' => array('login', 'logout', 'set', 'error'),
                'users'=>array('*'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
	
	public function actionIndex(){
		// $this->redirect(Yii::app()->user->adminReturnUrl);
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionProfile($id){
		$this->layout = '/layouts/custom';

		if(Yii::app()->user->id != $id)
			throw new HttpException(403, 'Доступ запрещен');

		$user = AdminUser::model()->findByPk($id);
		$user->pass = '';

		if(isset($_POST['AdminUser'])){
			$user->attributes = $_POST['AdminUser'];

			if($user->save())
				$this->redirect($this->createUrl('profile', array('id' => $user->id)));
		}

		if(!$user)
			throw new HttpException(404, 'Пользователь не найден');

		$this->render('profile', array('model' => $user));
	}

	public function actionLogin(){
		$this->layout = '/layouts/login';

		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

	    // collect user input data
	    if(isset($_POST['LoginForm']))
	    {
	        $model->attributes=$_POST['LoginForm'];
	        // validate user input and redirect to previous page if valid
	        if($model->validate()  && $model->login()) 
	        	$this->redirect(Yii::app()->user->adminReturnUrl);
	    }
	    // display the login form
	    $this->render('login',array('model'=>$model));
	}

	public function actionLogout(){
		Yii::app()->user->logout(false);
		$this->redirect($this->createUrl(Yii::app()->user->loginUrl));
	}

	public function actionSet(){
		$auth=Yii::app()->authManager;
 
		// $auth->createOperation('createPost','создание записи');
		// $auth->createOperation('readPost','просмотр записи');
		$auth->createOperation('updateUser','редактирование записи');
		// $auth->createOperation('deletePost','удаление записи');
		 
		$bizRule='return Yii::app()->user->id==$params["user"]->id;';
		$task=$auth->createTask('updateOwnInfo','редактирование своей учетной записи',$bizRule);
		$task->addChild('updateUser');
		 
		// $role=$auth->createRole('reader');
		// $role->addChild('readPost');
		 
		$role=$auth->createRole('agent');
		$role->addChild('updateUser');
		// $role->addChild('updateOwnPost');
		/*$role->addChild('reader');
		$role->addChild('createPost');
		$role->addChild('updateOwnPost');*/
		 
		/*$role=$auth->createRole('editor');
		$role->addChild('reader');
		$role->addChild('updatePost');*/
		 
		$role=$auth->createRole('admin');
		$role->addChild('agent');
		/*$role->addChild('author');
		$role->addChild('deletePost');*/
		 
		// $auth->assign('agent','agentA');
		$auth->assign('admin', 1);
	}
}