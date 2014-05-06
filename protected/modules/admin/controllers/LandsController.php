<?php

class LandsController extends AdminController
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
        $model = new Lands;

        //Фильтр грида
        if(isset($_GET['Lands'])){
            $model->attributes = $_GET['Lands'];

            if(isset($_GET['Lands']['priceBegin']))
                $model->priceBegin = $_GET['Lands']['priceBegin'];
            if(isset($_GET['Lands']['priceEnd']))
                $model->priceEnd = $_GET['Lands']['priceEnd'];
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
        $model = Lands::model()->findByPk($id);
        $old_agent_id = $model->user_id;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(!Yii::app()->user->checkAccess('admin') && Yii::app()->user->id != $model->user_id)
            throw new CHttpException(403, 'Доступ запрещен!');

        if(isset($_POST['Lands'])){
            $model->attributes = $_POST['Lands'];
            $model->user_id = $old_agent_id;

            if($model->save())
                $this->redirect($this->createUrl('list'));
        }

        $this->render('update', array('model' => $model));
    }

	/*public function actionSetLocalities($id){

		$city = LandCities::model()->findByPk($id);

		if(!$city)
			throw new CHttpException(404, '404 Error');

		$model = new Lands;

		if($city->localities)
			echo TbHtml::activeDropDownListControlGroup($model,'locality_id', CHtml::listData($city->localities, 'id', 'name'));

		Yii::app()->end();
	}*/

	public function actionGetDeleteForm($id){
        $model = Lands::model()->findByPk($id);

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(isset($_POST['Lands'])){
            $model->attributes = $_POST['Lands'];

            $model->status = Lands::STATUS_REMOVED;
            $model->update(array('status', 'delete_reason'));

            echo "ok";
            Yii::app()->end();
        }

        $this->renderPartial('_modal', array('model' => $model));

        Yii::app()->end();
    }

	public function actionCart(){
        $model = new Lands;

        $criteria = new CDbCriteria;
        $criteria->compare('status', Lands::STATUS_REMOVED);

        if(isset($_GET['Lands'])){
            $model->attributes = $_GET['Lands'];

            $criteria->compare('delete_reason', $model->delete_reason);
        }

        $dataProvider = new CActiveDataProvider('Lands', array(
            'criteria'=>$criteria,
        ));

        $this->render('cart', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));
    }


    //for cart action
    public function actionChangeStatus($id, $val){
        $model = Lands::model()->findByPk($id);
        // $deleteApartment = new DeleteApartments;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        $model->status = (int) $val;
        $model->update(array('status'));

        Yii::app()->end();
    }
}
