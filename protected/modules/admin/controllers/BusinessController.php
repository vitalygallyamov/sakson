<?php

class BusinessController extends AdminController
{
	public $layout = '/layouts/custom';

    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'actions' => array('list', 'create', 'update', 'getDeleteForm', 'changeStatus', 'view'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions' => array('cart', 'delete'),
                'roles'=>array('admin'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionList(){
        $model = new Business;

        //Фильтр грида
        if(isset($_GET['Business'])){
            $model->attributes = $_GET['Business'];

            /*if(isset($_GET['Business']['priceBegin']))
                $model->priceBegin = $_GET['Business']['priceBegin'];
            if(isset($_GET['Business']['priceEnd']))
                $model->priceEnd = $_GET['Business']['priceEnd'];*/
        }

        if(!Yii::app()->user->checkAccess('admin')){
            $own = $model->search();
            $notOwn = $model->searchNotOwn();

            $dataProvider = new CArrayDataProvider(array_merge($own->data, $notOwn->data));
        }else
            $dataProvider = $model->search();

        $this->render('list', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));
    }

    public function actionUpdate($id){
        $model = Business::model()->findByPk($id);
        $old_agent_id = $model->user_id;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(!Yii::app()->user->checkAccess('admin') && Yii::app()->user->id != $model->user_id)
            throw new CHttpException(403, 'Доступ запрещен!');

        if(isset($_POST['Business'])){
            $model->attributes = $_POST['Business'];

            //check on exist agent
            $agent = AdminUser::model()->findByPk($old_agent_id);
            if($agent)
                $model->user_id = $old_agent_id;

            if($model->save())
                $this->redirect($this->createUrl('list'));
        }

        $this->render('update', array('model' => $model));
    }

    public function actionCart(){
        $model = new Business;

        $criteria = new CDbCriteria;
        $criteria->compare('status', Business::STATUS_REMOVED);

        if(isset($_GET['Business'])){
            $model->attributes = $_GET['Business'];

            $criteria->compare('delete_reason', $model->delete_reason);
        }

        $dataProvider = new CActiveDataProvider('Business', array(
            'criteria'=>$criteria,
        ));

        $this->render('cart', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));
    }

    //for cart action
    public function actionChangeStatus($id, $val){
        $model = Business::model()->findByPk($id);
        // $deleteApartment = new DeleteApartments;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        $model->status = (int) $val;
        $model->update(array('status'));

        Yii::app()->end();
    }

    public function actionGetDeleteForm($id){
        $model = Business::model()->findByPk($id);

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(isset($_POST['Business'])){
            $model->attributes = $_POST['Business'];

            $model->status = Business::STATUS_REMOVED;
            $model->update(array('status', 'delete_reason'));

            echo "ok";
            Yii::app()->end();
        }

        $this->renderPartial('_modal', array('model' => $model));

        Yii::app()->end();
    }
}
