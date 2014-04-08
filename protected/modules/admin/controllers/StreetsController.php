<?php

class StreetsController extends AdminController
{
	public function actionAllJson($q){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('id, name as text')
			->from('{{streets}}')
			->where(array('like', 'name', '%'.$q.'%'))
			->order('name')
			->queryAll();

		//array_unshift($result, array('id' => 0, 'text' => 'Нет'));

		echo CJSON::encode($result);

		Yii::app()->end();
	}

	public function actionGetOneById($id){
		header('Content-type: application/json');

		$result = Yii::app()->db->createCommand()
			->select('id, name as text')
			->from('{{streets}}')
			->where('id=:id', array(':id' => $id))
			->queryRow();

		if($result) echo CJSON::encode($result);
		else echo CJSON::encode(array('id' => 0, 'text' => 'Нет'));

		Yii::app()->end();
	}
}
