<?php

class ApartmentsController extends AdminController
{
	public $layout = '/layouts/custom';

    public function actionGetDeleteForm($id){
        $model = Apartments::model()->findByPk($id);
        $deleteApartment = new DeleteApartments;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(isset($_POST['DeleteApartments'])){
            $deleteApartment->attributes = $_POST['DeleteApartments'];

            if($deleteApartment->validate()){
                $deleteApartment->save(false);
                $model->status = Apartments::STATUS_REMOVED;
                $model->update(array('status'));

                echo "ok";
            }else{
                $this->renderPartial('_modal', array('deleteApartment' => $deleteApartment, 'model' => $model));
            }

            Yii::app()->end();
        }
        $deleteApartment->apart_id = $model->id;
        $deleteApartment->user_id = Yii::app()->user->id;

        $this->renderPartial('_modal', array('deleteApartment' => $deleteApartment, 'model' => $model));

        Yii::app()->end();
    }

    public function actionList(){
        $model = new Apartments;

        if(isset($_GET['Apartments']))
            $model->attributes = $_GET['Apartments'];
        
        if(isset($_GET['priceBegin'])) $model->priceBegin = $_GET['priceBegin'];
        if(isset($_GET['priceEnd'])) $model->priceEnd = $_GET['priceEnd'];

        $this->render('list', array(
            'model' => $model
        ));
    }
}
