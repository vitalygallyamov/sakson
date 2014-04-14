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

        /*if(isset($_POST['DeleteApartments'])){
            $deleteApartment->attributes = $_POST['DeleteApartments'];

            if($deleteApartment->validate()){
                $deleteApartment->save(false);
                $model->status = Apartments::STATUS_REMOVED;
                $model->update(array('status'));

                echo "ok";
            }else{
                $this->renderPartial('_modal', array('deleteApartment' => $deleteApartment, 'model' => $model));
            }

            Yii::app()->end();
        }*/
        /*$deleteApartment->apart_id = $model->id;
        $deleteApartment->user_id = Yii::app()->user->id;*/

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

        $filter = new Apartments;
        $filterData = null;

        //Фильтр грида
        if(!isset($_GET['Apartments']['Filter']) && isset($_GET['Apartments'])){
            $model->attributes = $_GET['Apartments'];
        }

        //Находим квартиры других агентов через фильтр
        if(isset($_GET['Apartments']['Filter'])){
            $getFilter = $_GET['Apartments']['Filter'];
            $filter->attributes = $getFilter;

            // if(isset($_GET['Apartments'])) $filter->attributes = $_GET['Apartments'];

            $filter->priceBegin = $getFilter['priceBegin'];
            $filter->priceEnd = $getFilter['priceEnd'];

            $filterData = $filter->searchNotOwn();
        }

        //if(isset($_GET['Apartments'])){print_r($_GET); die();}

        $this->render('list', array(
            'model' => $model,
            'filter' => $filter,
            'filterData' => $filterData
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
