<?php

class CatalogController extends FrontController
{
	public $layout='//layouts/page';

	public $defaultAction = 'apartments';
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'apartments', 'lands', 'favorites', 'addToFavorites', 'deleteFromFavorites'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function beforeAction($action){
		$this->subMenu = array(
			array('name' => 'Квартиры', 'url' => $this->createUrl('apartments'), 'active' => $action->id == 'apartments'),
			array('name' => 'Загородная', 'url' => $this->createUrl('lands'), 'active' => $action->id == 'lands'),
			array('name' => 'Избранное', 'url' => $this->createUrl('favorites'), 'active' => $action->id == 'favorites'),
		);

		return parent::beforeAction($action);
	}

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel('Lands', $id),
		));
	}

	
	public function actionIndex()
	{
		// $dataProvider=new CActiveDataProvider('Lands');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
	}

	public function actionApartments(){
		$this->seo = Seo::model()->find();

		$model = new Apartments;

		$criteria = new CDbCriteria;
		$criteria->addCondition('status=1');

		if(isset($_GET['Apartments'])){
			$model->attributes = $_GET['Apartments'];

			$criteria->compare('area_id',$model->area_id);
			$criteria->compare('series_id',$model->series_id);

			if($model->added && is_array($model->added)){
				foreach ($model->added as $value) {
					$criteria->compare('added', $value, true);
				}
			}

			if($model->apartment_type_id && is_array($model->apartment_type_id)){
				$rooms_criteria = new CDbCriteria;
				foreach ($model->apartment_type_id as $k => $value) {
					$rooms_criteria->addCondition('apartment_type_id=:r'.$k, 'OR');

					$rooms_criteria->params[':r'.$k] = $value;
				}
				$criteria->mergeWith($rooms_criteria);
			}

			//price 
			if($_GET['price_from'] > 0 && $_GET['price_to'] > 0)
				$criteria->addBetweenCondition('price', $_GET['price_from'] * 1000, $_GET['price_to'] * 1000);
			
			//square
			if($_GET['square_from'] > 0 && $_GET['square_to'] > 0)
				$criteria->addBetweenCondition('square', $_GET['square_from'], $_GET['square_to']);

			//floor
			if($_GET['floor_from'] > 0 && $_GET['floor_to'] > 0)
				$criteria->addBetweenCondition('floor', $_GET['floor_from'], $_GET['floor_to']);

		} 

		$dataProvider=new CActiveDataProvider('Apartments', array(
			'pagination'=>array(
				'pageSize'=>10,
			),
			'criteria'=>$criteria,
		));

		$this->render('apartments/main', array('dataProvider'=>$dataProvider, 'model' => $model));
	}

	public function actionFavorites(){

		$this->seo = Seo::model()->find();

		$is_cookie = isset(Yii::app()->request->cookies['favorites']);

		$values = array();
		if($is_cookie){
			$values = unserialize(Yii::app()->request->cookies['favorites']->value);
		}

		$criteria = new CDbCriteria;

		//only apartments yet
		$ids = array();
		foreach ($values as $key => $value) {
			$ids[] = $value['id'];
		}

		$criteria->addInCondition('id', $ids);

		$dataProvider=new CActiveDataProvider('Apartments', array(
			'pagination'=>false,
			'criteria' => $criteria
		));

		$this->render('favorites', array('dataProvider'=>$dataProvider));
	}


	//Add to Favorites
	public function actionAddToFavorites($id, $type){
		$model = null;

		switch ($type) {
			case 'apartment':
				$model = Apartments::model()->findByPk($id);
				break;
			case 'land':
				$model = Lands::model()->findByPk($id);
				break;
		}

		if(!$model)
			throw new HttpException(404);

		$is_cookie = isset(Yii::app()->request->cookies['favorites']);

		$values = array();
		if($is_cookie){
			$values = unserialize(Yii::app()->request->cookies['favorites']->value);
		}

		$exist = false;
		foreach ($values as $value) {
			if($value['id'] == $id && $value['type'] == $type) $exist = true;
		}

		if(!$exist) $values[] = array('id' => $id, 'type' => $type);

		$cookie = new CHttpCookie('favorites', serialize($values));
		$cookie->expire = time()+60*60*24*180;
		Yii::app()->request->cookies['favorites'] = $cookie;

		Yii::app()->end();
	}

	//Delete from Favorites
	public function actionDeleteFromFavorites($id, $type){
		$model = null;

		switch ($type) {
			case 'apartment':
				$model = Apartments::model()->findByPk($id);
				break;
			case 'land':
				$model = Lands::model()->findByPk($id);
				break;
		}

		if(!$model)
			throw new HttpException(404);

		$is_cookie = isset(Yii::app()->request->cookies['favorites']);

		$values = array();
		if($is_cookie){
			$values = unserialize(Yii::app()->request->cookies['favorites']->value);
		}

		foreach ($values as $key => $value) {
			if($value['id'] == $id && $value['type'] == $type) unset($values[$key]);
		}

		$cookie = new CHttpCookie('favorites', serialize($values));
		$cookie->expire = time()+60*60*24*30; //30 days
		Yii::app()->request->cookies['favorites'] = $cookie;

		Yii::app()->end();
	}

	public function actionLands(){
		$this->seo = Seo::model()->find();
		$this->render('lands', array());
	}

	public function getDropDownList($className, $empty = false){
		if($empty)
			return array('' => 'Не выбрано') + CHtml::listData(call_user_func(array($className, 'all')), 'id', 'name');
		return CHtml::listData(call_user_func(array($className, 'all')), 'id', 'name');
	}
}
