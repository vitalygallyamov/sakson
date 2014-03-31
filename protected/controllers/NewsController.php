<?php

class NewsController extends FrontController
{
	public $layout='//layouts/page';

	public function actionView($year, $url)
	{
        $data["model"] = News::model()->findByAttributes(array("url"=>$url), "status=:status", array(":status"=>News::STATUS_PUBLISH));
        if(!$data["model"])
            throw new CHttpException(404, "Страница не найдена!");

        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.fancybox.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css', "screen");

        $this->subMenu = $this->getSubMenu();

        $criteria = new CDbCriteria;

        $criteria->addCondition("YEAR(dt_date)=:year", "AND");
        $criteria->params = array(":year"=>$year);
        $criteria->order = "dt_date DESC";

        $data['dataProvider'] = new CActiveDataProvider('News', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>3,
                'pageVar'=>'pager',
            ),
        ));

        $this->seo->meta_title = $data["model"]->name." / Агенство недвижимости Саксон";

        $data["photos"]= $data["model"]->gallery->galleryPhotos;

		$this->render('view', $data);
	}

	public function actionIndex($year = null)
	{
        $criteria = new CDbCriteria;

        $criteria->addCondition("status=".News::STATUS_PUBLISH);
        $criteria->order = "dt_date DESC";

        if($year != null)
            $criteria->addCondition("YEAR(dt_date)=:year");

        $criteria->params = array(":year"=>$year);

		$last_news = News::model()->find($criteria);
        if($last_news)
            $this->redirect("/news/{$last_news->year}/{$last_news->url}");
        else
            throw new CHttpException(404, "Страница не найдена!");
	}

    public function getSubMenu(){
        $years = Yii::app()->db->createCommand()
            ->select("DISTINCT(YEAR(dt_date)) year")
            ->from("tbl_news")
            ->where("status=".News::STATUS_PUBLISH)
            ->order("dt_date ASC")
            ->queryAll();
        $subMenu = null;
        if($years){
            foreach($years as $y){
                $subMenu[] = array(
                    "name"=>$y["year"],
                    "url"=>($_GET["year"]==$y['year']) ? "/news/{$y['year']}/{$_GET['url']}" : "/news/{$y['year']}",
                    "active"=>($_GET["year"]==$y['year']) ? true : false,
                );
            }
        }
        return $subMenu;
    }
}
