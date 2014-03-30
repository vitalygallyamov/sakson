<?php

	$cs = Yii::app()->clientScript;
	$cs->registerCssFile($this->getAssetsUrl().'/css/styles.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/jcarousel.basic.css');

	$cs->registerCoreScript('jquery');
	$cs->registerCoreScript('jquery.ui');
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.jcarousel.min.js', CClientScript::POS_END);
	
	$cs->registerScriptFile($this->getAssetsUrl().'/js/jcarousel.basic.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.ui.timepicker.ru.js', CClientScript::POS_END);
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

<div class="line slider">
    <div class="line995px">
        <div class="line_content">
            <!-- slider -->
            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul>
                        <li>
                            <div class="header_slider">
                                <img src="/media/images/logo60.png"><br>
                                <img  class="logo_sub" src="/media/images/logo_sub_70.png">

                            </div>
                        </li>
                        <li>
                            <div class="header_slider">
                                <img src="/media/images/logo60.png"><br>
                                <img class="logo_sub" src="/media/images/logo_sub_70.png">

                            </div>
                        </li>
                        <li>
                            <div class="header_slider">
                                <img src="/media/images/logo60.png"><br>
                                <img class="logo_sub" src="/media/images/logo_sub_70.png">

                            </div>
                        </li>

                    </ul>
                </div>

                <a href="#" class="jcarousel-control-prev"><img src="/media/images/slider_to_left.png"></a>
                <a href="#" class="jcarousel-control-next"><img src="/media/images/slider_to_right.png"></a>

                <center><p class="jcarousel-pagination">

                    </p></center>
            </div>

        </div>
    </div>
</div>

<div class="line index_content">
    <div class="line995px">
        <div class="line_content">
            <?=$content?>

            <div class="clear"></div>

            <!-- Новости -->
            <? $this->widget("ext.news.newsWidget"); ?>
            <div class="clear"></div>

        </div>
    </div>
</div>

<? $this->widget('ext.partners.partnersWidget'); ?>

    <? $this->renderPartial('/layouts/_footer'); ?>
</div>
</DIV><!-- main -->
</body>
</html>