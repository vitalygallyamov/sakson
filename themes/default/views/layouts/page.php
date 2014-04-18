<?php

	$cs = Yii::app()->clientScript;
	$cs->registerCssFile($this->getAssetsUrl().'/css/styles.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/jcarousel.basic.css');

	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.jcarousel.min.js', CClientScript::POS_END);
	
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jcarousel.basic.js', CClientScript::POS_END);
	// $cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.ui.timepicker.ru.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <meta charset="utf-8">

    <title><?=$this->seo->meta_title?></title>
    <meta name="description" content="<?=$this->seo->meta_desc?>" />
    <meta name="keywords" content="<?=$this->seo->meta_keys?>" />
</head>
<body>
<DIV class="main">
    <? $this->widget("ext.mainMenu.mainMenuWidget"); ?>

    <div class="line header">
        <div class="line995px">
            <div class="line_content">
                <a href="/"><img src="/media/images/logo.png" class="logo_second" title="Саксон"></a>
                <?if($this->id == 'catalog' || $this->id == 'favorites'):?>
                <div class="minihouse">
                    <img src="<?=$this->getAssetsUrl()?>/images/minihouse.png" alt="" />
                    <p>Новостройки и вторичка без<br />комиссии для покупателей</p>
                </div>
                <?endif;?>
                <a href="#" class="but right">Мы заботимся о наших клиентах</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <? $this->widget("ext.subMenu.subMenuWidget", array('subMenuItems'=>$this->subMenu)); ?>
    
    <div class="line second_content">
        <div class="line995px">
            <div class="line_content">
                <?=$content?>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="line splitter_footer">
        <div class="hack"></div>
    </div>

    <div class="line footer secont_footer">
        <? $this->renderPartial('/layouts/_footer'); ?>
    </div>
</DIV><!-- main -->
</body>
</html>