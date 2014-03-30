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
				'actions'=>array('index','view', 'apartments', 'lands'),
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

		$dataProvider=new CActiveDataProvider('Apartments', array(
			'criteria'=>array(
				'condition'=>'status=1',
			),
		));

		$this->render('apartments/main', array('dataProvider'=>$dataProvider));
	}

	public function actionLands(){
		$this->seo = Seo::model()->find();
		$this->render('lands', array());
	}
}
