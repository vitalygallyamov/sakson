<?php

class AdminModule extends EWebModule
{

	public $defaultController = 'user';


	public function init()
	{
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
            'admin.helpers.*',
            'appext.EPhpThumb.EPhpThumb',
        ));

        Yii::app()->setComponents(array(
            'errorHandler' => array(
                'errorAction' => 'admin/user/error'),
            'user' => array(
                'class' => 'WebUser',
                'stateKeyPrefix' => '_admin',
                'loginUrl' => Yii::app()->createUrl($this->id . '/user/login'),
                'adminReturnUrl' => Yii::app()->createUrl('admin/apartments'),
            ),
            'authManager'=>array(
                'class'=>'CDbAuthManager',
                'connectionID'=>'db',
                'itemTable'=>'{{AuthItem}}', // Tabla que contiene los elementos de autorizacion
                'itemChildTable'=>'{{AuthItemChild}}', // Tabla que contiene los elementos padre-hijo
                'assignmentTable'=>'{{AuthAssignment}}', // Tabla que contiene la signacion usuario-autorizacion
            ),
        ));

        // Yii::app()->user->setStateKeyPrefix('_admin');
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            $this->registerBootstrap();
            $this->registerCoreScripts();

            // if(Yii::app()->getModule('admin')->user->isGuest){
            //     Yii::app()->request->redirect(Yii::app()->getModule('admin')->user->loginUrl);
            // }


            return true;
        }
        return false;
	}

    protected function registerCoreScripts()
    {
        parent::registerCoreScripts();
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/admin.css');
		Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/jquery-ui-bootstrap/custom-theme/jquery-ui-1.9.2.custom.css');
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/jquery-ui-bootstrap/custom-theme/jquery.ui.1.9.2.ie.css');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/js/knockout.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/js/magic.js', CClientScript::POS_END);
	}


}
