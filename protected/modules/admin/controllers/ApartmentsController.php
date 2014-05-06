<?php

class ApartmentsController extends AdminController
{
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


	public $layout = '/layouts/custom';

    public function actionGetDeleteForm($id){
        $model = Apartments::model()->findByPk($id);
        // $deleteApartment = new DeleteApartments;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(isset($_POST['Apartments'])){
            $model->attributes = $_POST['Apartments'];

            $model->status = Apartments::STATUS_REMOVED;
            $model->update(array('status', 'delete_reason'));

            echo "ok";
            Yii::app()->end();
        }

        $this->renderPartial('_modal', array('model' => $model));

        Yii::app()->end();
    }

    public function actionUpdate($id){
        $model = Apartments::model()->findByPk($id);
        $old_agent_id = $model->agent_id;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(!Yii::app()->user->checkAccess('admin') && Yii::app()->user->id != $model->agent_id)
            throw new CHttpException(403, 'Доступ запрещен!');

        if(isset($_POST['Apartments'])){
            $model->attributes = $_POST['Apartments'];
            $model->agent_id = $old_agent_id;

            if($model->save())
                $this->redirect($this->createUrl('list'));
        }

        $this->render('update', array('model' => $model));
    }

    public function actionList(){
        $model = new Apartments;

        //Фильтр грида
        if(isset($_GET['Apartments'])){
            $model->attributes = $_GET['Apartments'];

            if(isset($_GET['Apartments']['priceBegin']))
                $model->priceBegin = $_GET['Apartments']['priceBegin'];
            if(isset($_GET['Apartments']['priceEnd']))
                $model->priceEnd = $_GET['Apartments']['priceEnd'];
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

    public function actionCart(){
        $model = new Apartments;

        $criteria = new CDbCriteria;
        $criteria->compare('status', Apartments::STATUS_REMOVED);

        if(isset($_GET['Apartments'])){
            $model->attributes = $_GET['Apartments'];

            $criteria->compare('delete_reason', $model->delete_reason);
        }

        $dataProvider = new CActiveDataProvider('Apartments', array(
            'criteria'=>$criteria,
        ));

        $this->render('cart', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));
    }

    public function actionChangeStatus($id, $val){
        $model = Apartments::model()->findByPk($id);
        // $deleteApartment = new DeleteApartments;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        $model->status = (int) $val;
        $model->update(array('status'));

        Yii::app()->end();
    }
}
