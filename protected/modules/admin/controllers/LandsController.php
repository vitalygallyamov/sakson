<?php

class LandsController extends AdminController
{
	public $layout = '/layouts/custom';

	public function actionSetLocalities($id){

		$city = LandCities::model()->findByPk($id);

		if(!$city)
			throw new CHttpException(404, '404 Error');

		$model = new Lands;

		if($city->localities)
			echo TbHtml::activeDropDownListControlGroup($model,'locality_id', CHtml::listData($city->localities, 'id', 'name'));

		Yii::app()->end();
	}
}
