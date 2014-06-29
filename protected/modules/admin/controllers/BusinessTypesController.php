<?php

class BusinessTypesController extends AdminController
{
	public function actionGetChildTypes($id){
        $type = BusinessTypes::model()->findByPk($id);
        
        if($type->children)
        	$this->renderPartial('_select', array('data' => $type->children));

        Yii::app()->end();
    }
}
