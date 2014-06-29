<?php

class FavoritesController extends FrontController
{
	public $layout='//layouts/page';

	public function beforeAction($action){
		$this->subMenu = array(
			array('name' => 'Квартиры', 'url' => $this->createUrl('catalog/apartments'), 'active' => $action->id == 'apartments'),
			array('name' => 'Загородная', 'url' => $this->createUrl('catalog/lands'), 'active' => $action->id == 'lands'),
			array('name' => 'Для бизнеса', 'url' => $this->createUrl('catalog/business'), 'active' => $action->id == 'business'),
			array('name' => 'Избранное', 'url' => $this->createUrl('favorites/index'), 'active' => $action->id == 'favorites'),
		);

		return parent::beforeAction($action);
	}

	public function actionIndex(){
		$this->seo = Seo::model()->find();

		$is_cookie = isset(Yii::app()->request->cookies['favorites']);

		$values = array();
		if($is_cookie){
			$values = unserialize(Yii::app()->request->cookies['favorites']->value);
		}

		$all = array();
		foreach ($values as $key => $value) {
			$item = null;

			switch ($value['type']) {
				case 'apartment':
					$item = Apartments::model()->findByPk($value['id']);
					break;
				case 'land':
					$item = Lands::model()->findByPk($value['id']);
					break;
				case 'business':
					$item = Business::model()->findByPk($value['id']);
					break;
			}

			if($item->status == 1) $all[] = $item;
		}

		$dataProvider=new CArrayDataProvider($all, array(
			'pagination'=>array(
				'pageSize' => 18
			)
		));

		$this->render('index', array('dataProvider'=>$dataProvider));
	}

	//Add to Favorites
	public function actionAdd($id, $type){
		$model = null;

		switch ($type) {
			case 'apartment':
				$model = Apartments::model()->findByPk($id);
				break;
			case 'land':
				$model = Lands::model()->findByPk($id);
				break;
			case 'business':
				$model = Business::model()->findByPk($id);
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
	public function actionDelete($id, $type){
		$model = null;

		switch ($type) {
			case 'apartment':
				$model = Apartments::model()->findByPk($id);
				break;
			case 'land':
				$model = Lands::model()->findByPk($id);
				break;
			case 'business':
				$model = Business::model()->findByPk($id);
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
}