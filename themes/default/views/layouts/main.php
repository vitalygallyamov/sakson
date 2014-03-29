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
            <div class="block">
                <h3>Последние новости</h3>
                <div class="block half last_news">

                    <div class="media_news">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/200x150">
                        </a>
                        <div class="media-body">
                            <div class="media_news_date">12</div>
                            <div class="media_news_month">Март</div>

                            <h4>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </h4>

                            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus...
                        </div>
                    </div>

                </div>
                <div class="block half last_news">

                    <div class="media_news">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/200x150">
                        </a>
                        <div class="media-body">
                            <div class="media_news_date">12</div>
                            <div class="media_news_month">Март</div>

                            <h4>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </h4>

                            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus...
                        </div>
                    </div>

                </div>

            </div>
            <div class="clear"></div>

        </div>
    </div>
</div>

<div class="line index_content_light">
    <div class="line995px">
        <div class="line_content">
            <div class="block">
                <h3>Наши партнеры</h3>
                <div class="block_center partners">
                    <img src="/media/images/partners/partner_1.png" style="margin-bottom:40px" id="partner_1" class="partner">
                    <img src="/media/images/partners/partner_2.png" style="margin-bottom:25px" id="partner_2" class="partner">
                    <img src="/media/images/partners/partner_3.png" style="margin-bottom:40px" id="partner_3" class="partner"><br>
                    <img src="/media/images/partners/partner_4.png" style="margin-bottom:40px" id="partner_4" class="partner">
                    <img src="/media/images/partners/partner_5.png" style="margin-bottom:40px" id="partner_5" class="partner">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="line footer">

    <div class="foo_light">
        <div class="line995px">
            <div class="line_content">
                <input type="hidden" id="old_id">
                <script type="text/javascript">
                    $(document).ready(function(){

                        $(".partner").bind("click", function(e){

                            id = $(this).attr("id");

                            $("#"+id).attr("src","/media/images/partners/"+id+"_color.png");
                            $("#"+$("#old_id").val()).attr("src","/media/images/partners/"+$("#old_id").val()+".png");
                            $(".partner_container").hide(100);
                            $("#container_"+id).show(200);
                            $("#old_id").val(id);
                        });

                    });

                </script>
                <div id="container_partner_1" class="partner_container">

                    <h4>1ВТБ24</h4>

                    <p>Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices  posuere  cubilia кааCurae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bib sfgw wlasfev
                        endum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse
                    </p>
                </div>
                <div id="container_partner_2" class="partner_container">
                    <h4>2ВТБ24</h4>

                    <p>Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices  posuere  cubilia кааCurae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bib sfgw wlasfev
                        endum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse
                    </p>
                </div>
                <div id="container_partner_3" class="partner_container">
                    <h4>3ВТБ24</h4>

                    <p>Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices  posuere  cubilia кааCurae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bib sfgw wlasfev
                        endum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse
                    </p>
                </div>
                <div id="container_partner_4" class="partner_container">
                    <h4>4ВТБ24</h4>

                    <p>Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices  posuere  cubilia кааCurae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bib sfgw wlasfev
                        endum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse
                    </p>
                </div>
                <div id="container_partner_5" class="partner_container">
                    <h4>5ВТБ24</h4>

                    <p>Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices  posuere  cubilia кааCurae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bib sfgw wlasfev
                        endum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="foo_dark">
        <div class="line995px">
            <div class="line_content">
                <div class="block half">
                    <div class="adr">
                        <?=$this->settings["address"]?>
                    </div>
                    <div class="phones">
                        <?=$this->settings["phone"]?>
                    </div>
                </div>
                <div class="block half">
                    <ul class="social">
                        <li>
                            <a href="<?=$this->settings["fb_link"]?>"><img src="/media/images/social/1.png"></a>
                        </li>
                        <li>
                            <a href="<?=$this->settings["tw_link"]?>"><img src="/media/images/social/2.png"></a>
                        </li>
                        <li>
                            <a href="<?=$this->settings["vk_link"]?>"><img src="/media/images/social/3.png"></a>
                        </li>
                        <li>
                            <a href="<?=$this->settings["sk_link"]?>"><img src="/media/images/social/4.png"></a>
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