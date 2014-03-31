<?php

class ApartmentsController extends AdminController
{
	public $layout = '/layouts/custom';

    public function actionGetDeleteForm($id){
        $model = Apartments::model()->findByPk($id);
        // $deleteApartment = new DeleteApartments;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        if(isset($_POST['Apartments'])){
            $model->attributes = $_POST['Apartments'];

            $model->status = Apartments::STATUS_REMOVED;
            $model->update(array('status', 'delete_reason'));

            echo "ok";
            Yii::app()->end();
        }
        /*if(isset($_POST['DeleteApartments'])){
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
        }*/
        /*$deleteApartment->apart_id = $model->id;
        $deleteApartment->user_id = Yii::app()->user->id;*/

        $this->renderPartial('_modal', array('model' => $model));

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

    public function actionCart(){
        $model = new Apartments;

        $criteria = new CDbCriteria;
        $criteria->compare('status', Apartments::STATUS_REMOVED);

        if(isset($_GET['Apartments'])){
            $model->attributes = $_GET['Apartments'];

            $criteria->compare('delete_reason', $model->delete_reason);
        }

        $dataProvider = new CActiveDataProvider('Apartments', array(
            'criteria'=>$criteria,
        ));

        $this->render('cart', array(
            'model' => $model,
            'dataProvider' => $dataProvider
        ));
    }

    public function actionChangeStatus($id, $val){
        $model = Apartments::model()->findByPk($id);
        // $deleteApartment = new DeleteApartments;

        if(!$model) 
            throw new CHttpException(404, 'Объект не найден');

        $model->status = (int) $val;
        $model->update(array('status'));

        Yii::app()->end();
    }
}
