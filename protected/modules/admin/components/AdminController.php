<?php

Yii::import('admin.actions.*');

class AdminController extends Controller
{
    public $layout = '/layouts/admin_columns';
	public $defaultAction = 'list';

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
                // 'actions' => array('list', 'create', 'update', ''),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
	
	public function actions()
    {
        return array(
            'list' => 'ListAction',
			'create' => 'CreateAction',
            'update' => 'UpdateAction',
            'delete' => 'DeleteAction',
            'restore' => 'RestoreAction',
            'view' => 'ViewAction',
            'sort' => 'SortAction',
        );
    }

    /**
     * Render SEO form for @param $model
     */
    public function getSeoForm($model){
        if($model->metaData->hasRelation('seo')){
            $seo = new Seo;

            if(isset($model->seo_id)){
                $seo = Seo::model()->findByPk($model->seo_id);
            }

            return $this->renderPartial('/seo/_form', array('model' => $seo, 'title' => $model->getAttributeLabel('seo_id')), true);
        }
    }
}