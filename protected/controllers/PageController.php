<?php

class PageController extends FrontController
{
	public $layout='//layouts/page';

	public function actionIndex($url)
	{
		$data["model"] = $this->getModel($url);
        $this->seo = $data["model"]->seo;
		$this->render('index', $data);
	}

    public function getModel($url=null){
        if($url == null)
            $model = Page::model()->findByAttributes(array("url"=>"/", "status"=>Page::STATUS_PUBLISH));
        else
            $model = Page::model()->findByAttributes(array("url"=>$url, "status"=>Page::STATUS_PUBLISH));

        if($model)
            return $model;

        throw new CHttpException(404, "Страница не найдена!");
    }
}