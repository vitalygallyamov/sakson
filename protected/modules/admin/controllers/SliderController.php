<?php

class SliderController extends AdminController
{
    public $layout = '/layouts/custom';

    public function actionCreate(){
        $model = new Slider;

        if(isset($_POST["Slider"]))
        {
            $model->attributes = $_POST["Slider"];
            if(!empty($_FILES["Slider"]["name"]["img_photo"])){
                $model->img_photo = $_FILES["Slider"]["name"]["img_photo"];
            }
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/slider/list');
            }
        }

        $this->render("create", array('model' => $model));
    }

    public function actionUpdate($id){
        $model = Slider::model()->findByPk($id);

        if (isset($_POST["Slider"]['deletePhoto'])) {
            $behaviorName = 'imgBehavior'.ucfirst( $_POST["Slider"]['deletePhoto'] );
            $model->{$behaviorName}->deletePhoto();
            if ( Yii::app()->request->isAjaxRequest ) {
                Yii::app()->end();
            }
        }

        if(isset($_POST["Slider"]))
        {
            $imgPhoto = $model->img_photo;
            $model->attributes = $_POST["Slider"];
            $model->img_photo = $imgPhoto;
            if($_FILES["Slider"]["error"]["img_photo"] == 0){
                $model->img_photo = $_FILES["Slider"]["name"]["img_photo"];
            }
            $success = $model->save();
            if( $success ) {
                $this->redirect('/admin/slider/list');
            }
        }
        $this->render('update', array('model' => $model));
    }
}
