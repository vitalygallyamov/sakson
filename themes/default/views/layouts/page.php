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

    <div class="line header">
        <div class="line995px">
            <div class="line_content">
                <a href="/"><img src="/media/images/logo60.png" class="logo_second" title="Саксон"></a>

                <a href="#" class="but right">Мы заботимся о наших клиентах</a>
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

    </div>

    <div class="line footer secont_footer">
        <div class="foo_dark">
            <div class="line995px">
                <div class="line_content">
                    <div class="block half">
                        <div class="adr">
                            <?=isset($this->settings["address"]) ? $this->settings["address"] : ''?>
                        </div>
                        <div class="phones">
                             <?=isset($this->settings["phone"]) ? $this->settings["phone"] : ''?>
                        </div>
                    </div>
                    <div class="block half">
                        <ul class="social">
                            <li>
                                <a href="<?=isset($this->settings["fb_link"]) ? $this->settings["fb_link"] : ''?>"><img src="/media/images/social/1.png"></a>
                            </li>
                            <li>
                                <a href="<?=isset($this->settings["tw_link"]) ? $this->settings["tw_link"] : ''?>"><img src="/media/images/social/2.png"></a>
                            </li>
                            <li>
                                <a href="<?=isset($this->settings["vk_link"]) ? $this->settings["vk_link"] : ''?>"><img src="/media/images/social/3.png"></a>
                            </li>
                            <li>
                                <a href="<?=isset($this->settings["sk_link"]) ? $this->settings["sk_link"] : ''?>"><img src="/media/images/social/4.png"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</DIV><!-- main -->
</body>
</html>