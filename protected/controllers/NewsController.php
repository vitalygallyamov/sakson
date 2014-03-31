<?php

class NewsController extends FrontController
{
	public $layout='//layouts/page';

	public function actionView($id)
	{
        $data["model"] = News::model()->findByPk($id, "status=:status", array(":status"=>News::STATUS_PUBLISH));
        if(!$data["model"])
            throw new CHttpException(404, "Страница не найдена!");

        $data["photos"]= $data["model"]->gallery->galleryPhotos;

		$this->render('view', $data);
	}

	public function actionIndex()
	{
		$this->seo = Seo::model()->find();
		
		$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
