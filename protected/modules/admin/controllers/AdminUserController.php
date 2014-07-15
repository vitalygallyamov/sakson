<?php

class AdminUserController extends AdminController
{
    public $layout = '/layouts/custom';

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('create', 'update', 'list', 'delete', 'getAgentForm', 'changeAgent'),
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

            if($model->validate()){
                /*Yii::app()->swiftmail->sendEmail("no-replay@sakson72.com", $model->email, 'Доступы в систему управления объектами недвижимости', $this->renderPartial('_email', array('model' => $model), true));*/
                //smtp
                Yii::app()->mailer->IsSMTP();
                Yii::app()->mailer->CharSet = 'UTF-8';
                Yii::app()->mailer->Username = Yii::app()->params['mail']['user'];
                Yii::app()->mailer->Password = Yii::app()->params['mail']['pass'];
                Yii::app()->mailer->Host = Yii::app()->params['mail']['host'];
                Yii::app()->mailer->SMTPAuth=true;
                Yii::app()->mailer->Port = Yii::app()->params['mail']['port'];
                Yii::app()->mailer->SMTPSecure = Yii::app()->params['mail']['protocol'];

                Yii::app()->mailer->From = 'postmaster@sakson72.ru';
                Yii::app()->mailer->FromName = 'Sakson';
                Yii::app()->mailer->AddReplyTo('vitgvr@gmail.com');
                Yii::app()->mailer->AddAddress($model->email);
                Yii::app()->mailer->Subject = 'Доступы в систему';
                Yii::app()->mailer->getView('create_agent_email', array('model' => $model));
                Yii::app()->mailer->IsHTML(true);
                Yii::app()->mailer->Send();
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

        $oldPass = $model->pass;

        if(!Yii::app()->user->checkAccess('admin') && Yii::app()->user->id != $model->id){
             throw new CHttpException(403, 'Ошибка доступа');
        }

        if(isset($_POST['AdminUser'])){
            $model->attributes = $_POST['AdminUser'];

            if(isset($_POST['role'])){
                $model->role = $_POST['role'];
            }

            if(!$model->pass) $model->pass = $oldPass;
            else $model->pass = $model->hashPassword($model->pass);

            if($model->save())
                $this->redirect($this->createUrl('list'));
        }

        $model->pass = '';

        $this->render('update', array(
            'model' => $model
        ));
    }

    public function actionGetAgentForm($id){
        $data = array();

        $agent = AdminUser::model()->findByPk($id);

        if($agent){
            $data['apartments'] = count($agent->apartments);
            $data['lands'] = count($agent->lands);
            $data['business'] = count($agent->business);
            $data['id'] = $id;

            $this->renderPartial('_change_agent_form', 
                array('data' => $data)
            );
        }

        Yii::app()->end();
    }

    public function actionChangeAgent(){
        if(isset($_POST['new_agent_id']) && isset($_POST['old_agent_id'])){

            $old_agent = AdminUser::model()->findByPk($_POST['old_agent_id']);
            $new_agent = AdminUser::model()->findByPk($_POST['new_agent_id']);

            if($old_agent && $new_agent && !$old_agent->isAdmin() && !$new_agent->isAdmin()){
                $command = Yii::app()->db->createCommand();

                $command->update('{{apartments}}', array('agent_id' => $new_agent->id), 'agent_id=:id', array(':id' => $old_agent->id));
                $command->update('{{lands}}', array('user_id' => $new_agent->id), 'user_id=:id', array(':id' => $old_agent->id));
                $command->update('{{business}}', array('user_id' => $new_agent->id), 'user_id=:id', array(':id' => $old_agent->id));

                $old_agent->delete();

                echo "ok";
            }

        }
        Yii::app()->end();
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
