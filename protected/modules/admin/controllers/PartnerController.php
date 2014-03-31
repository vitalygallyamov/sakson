<?php

class PartnerController extends AdminController
{
    public $layout = '/layouts/custom';

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                // 'actions' => array('list', 'create', 'update', ''),
                'roles'=>array('admin'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionCreate(){
        $model = new Partner;

        if(isset($_POST["Partner"]))
        {
            $model->attributes = $_POST["Partner"];
            if(!empty($_FILES["Partner"]["name"]["img_logo"])){
                $model->img_logo = $_FILES["Partner"]["name"]["img_logo"];
            }
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/partner/list');
            }
        }

        $this->render("create", array('model' => $model));
    }

    public function actionUpdate($id){
        $model = Partner::model()->findByPk($id);

        if (isset($_POST["Partner"]['deletePhoto'])) {
            $behaviorName = 'imgBehavior'.ucfirst( $_POST["Partner"]['deletePhoto'] );
            $model->{$behaviorName}->deletePhoto();
            if ( Yii::app()->request->isAjaxRequest ) {
                Yii::app()->end();
            }
        }

        if(isset($_POST["Partner"]))
        {
            $imgLogo = $model->img_logo;
            $model->attributes = $_POST["Partner"];
            $model->img_logo = $imgLogo;
            if($_FILES["Partner"]["error"]["img_logo"] == 0){
                $model->img_logo = $_FILES["Partner"]["name"]["img_logo"];
            }
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/partner/list');
            }
        }
        $this->render('update', array('model' => $model));
    }
}
