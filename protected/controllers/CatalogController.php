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
				'actions'=>array('index','view', 'apartments', 'lands', 'getDetailView'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function beforeAction($action){
		$this->subMenu = array(
			array('name' => 'Квартиры', 'url' => $this->createUrl('catalog/apartments'), 'active' => $action->id == 'apartments'),
			array('name' => 'Загородная', 'url' => $this->createUrl('catalog/lands'), 'active' => $action->id == 'lands'),
			array('name' => 'Избранное', 'url' => $this->createUrl('favorites/index'), 'active' => $action->id == 'favorites'),
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

		$criteria->distinct = true;
		$criteria->join = 'INNER JOIN gallery ON gllr_photos = gallery.id INNER JOIN gallery_photo ON gallery.id = gallery_photo.gallery_id';

		// $criteria->with = 'gallery';
		// $criteria->together = true;
		// $criteria->addCondition('galleryPhotos.file_name != ""');

		if(isset($_GET['Apartments'])){
			$model->attributes = $_GET['Apartments'];

			$criteria->compare('area_id',$model->area_id);
			$criteria->compare('series_id',$model->series_id);

			if($model->added && is_array($model->added)){

				$added_criteria = new CDbCriteria;
				foreach ($model->added as $k => $value) {
					$added_criteria->compare('added', $value, true, 'OR');
				}
				$criteria->mergeWith($added_criteria);
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
				$criteria->addBetweenCondition('price', $_GET['price_from'], $_GET['price_to']);
				//$criteria->addBetweenCondition('price', $_GET['price_from'] * 1000, $_GET['price_to'] * 1000);
			
			//square
			if($_GET['square_from'] > 0 && $_GET['square_to'] > 0)
				$criteria->addBetweenCondition('square', $_GET['square_from'], $_GET['square_to']);

			//floor
			if($_GET['floor_from'] > 0 && $_GET['floor_to'] > 0)
				$criteria->addBetweenCondition('floor', $_GET['floor_from'], $_GET['floor_to']);

		} 

		$dataProvider=new CActiveDataProvider('Apartments', array(
			'pagination'=>array(
				'pageSize'=>12
			),
			'criteria'=>$criteria,
		));

		$this->render('apartments/main', array('dataProvider'=>$dataProvider, 'model' => $model));
	}

	/*public function actionGetDetailView($id, $type = 'apartments'){
		$model = null;

		switch ($type) {
			case 'apartments':
				$model = Apartments::model()->findByPk($id);
				break;
			case 'lands':
				$model = Lands::model()->findByPk($id);
				break;
		}

		if(!$model)
			throw new HttpException(404);

		$this->renderPartial($type.'/_view_detail', array('data' => $model));

		Yii::app()->end();
	}
*/
	public function actionLands(){
		$this->seo = Seo::model()->find();

		$model = new Lands;

		$criteria = new CDbCriteria;
		$criteria->addCondition('status=1');

		$criteria->distinct = true;
		$criteria->join = 'INNER JOIN gallery ON gllr_images = gallery.id INNER JOIN gallery_photo ON gallery.id = gallery_photo.gallery_id';

		if(isset($_GET['Lands'])){
			$model->attributes = $_GET['Lands'];

			$criteria->compare('way_id',$model->way_id);
			$criteria->compare('locality_id',$model->locality_id);
			$criteria->compare('type_id',$model->type_id);
			$criteria->compare('state_id',$model->state_id);
			$criteria->compare('material_id',$model->material_id);
			$criteria->compare('target_id',$model->target_id);

			//price 
			if($_GET['price_from'] > 0 && $_GET['price_to'] > 0)
				$criteria->addBetweenCondition('price', $_GET['price_from'], $_GET['price_to']);
			
			//square_house
			if($_GET['square_h_from'] > 0 && $_GET['square_h_to'] > 0)
				$criteria->addBetweenCondition('square_house', $_GET['square_h_from'], $_GET['square_h_to']);

			//square_place
			if($_GET['square_p_from'] > 0 && $_GET['square_p_to'] > 0)
				$criteria->addBetweenCondition('square_place', $_GET['square_p_from'], $_GET['square_p_to']);

			//distance
			if($_GET['distance_from'] > 0 && $_GET['distance_to'] > 0)
				$criteria->addBetweenCondition('distance', $_GET['distance_from'], $_GET['distance_to']);

		} 

		$dataProvider=new CActiveDataProvider('Lands', array(
			'pagination'=>array(
				'pageSize'=>12
			),
			'criteria'=>$criteria,
		));

		$this->render('lands/main', array('dataProvider'=>$dataProvider, 'model' => $model));
	}

	public function getDropDownList($className, $empty = false){
		if($empty)
			return array('' => 'Не выбрано') + CHtml::listData(call_user_func(array($className, 'all')), 'id', 'name');
		return CHtml::listData(call_user_func(array($className, 'all')), 'id', 'name');
	}
}
