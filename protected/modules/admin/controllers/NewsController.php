<?php

class NewsController extends AdminController
{
    public $layout = '/layouts/custom';

    public function actionCreate(){
        $model = new News;

        if(isset($_POST["News"]))
        {
            $model->attributes = $_POST["News"];
            $model->dt_date = date("Y-m-d 10:00:00", strtotime($_POST["News"]["dt_date"]));
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/news/list');
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id){
        $model = News::model()->findByPk($id);

        if (isset($_POST["News"]['deletePhoto'])) {
            $behaviorName = 'imgBehavior'.ucfirst( $_POST["News"]['deletePhoto'] );
            $model->{$behaviorName}->deletePhoto();
            if ( Yii::app()->request->isAjaxRequest ) {
                Yii::app()->end();
            }
        }

        if(isset($_POST["News"]))
        {
            $model->attributes = $_POST["News"];
            $model->dt_date = date("Y-m-d 10:00:00", strtotime($_POST["News"]["dt_date"]));
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/news/list');
            }
        }
        $this->render('update',array('model' => $model));
    }
}
