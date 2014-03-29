<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller
{
    public $layout='//layouts/simple';
    public $menu=array();
    public $breadcrumbs=array();
    public $seo;
    public $subMenu = array();
    public $settings = array();

    public function init() {
        parent::init();
        $this->title = Yii::app()->name;
        $this->setSettings();
    }

    public function setSettings() {
        $settings = Settings::model()->cache(29000000)->findAll();
        if(!$settings)
            return;
        foreach($settings as $s){
            $this->settings[$s->name] = $s->{$s->type}->value;
        }
    }

    //Check home page
    public function is_home(){
        return $this->route == 'site/index';
    }

    public function beforeRender($view)
    {
        $this->renderPartial('//layouts/clips/_main_menu');
        return parent::beforeRender($view);
    }
}