<?php
$this->widget('EListView', array(
    'id' => 'favorites-list',
    'dataProvider'=>$dataProvider,
    //'template' => '{sorter}<div class="clear"></div>{items}<div class="clear"></div><br><a href="#" class="but to_mail">Отправить на почту</a>{pager}<div class="info">{summary}</div>',
    'template' => '{sorter}<div class="clear"></div>{items}<div class="clear"></div><br>{pager}<div class="info">{summary}</div>',
    'summaryText' => "<div class=\"left\">НАЙДЕНО : {count}</div><div class=\"right\">НА СТРАНИЦЕ : {start}-{end}</div>",
    'summaryCssClass' => '',
    'pagerCssClass' => 'pager',
    'cssFile' => false,
    'afterAjaxUpdate' => "js:function(){if($('.items .empty').length) $('.to_mail').hide()}",
    'pager' => array(
        'nextPageLabel' => CHtml::image($this->getAssetsUrl().'/images/pager_to_right.png'),
        'prevPageLabel' => CHtml::image($this->getAssetsUrl().'/images/pager_to_left.png'),
        'header' => '',
        'cssFile'=>false,
    ),
    // 'sorterCssClass' => 'sortblock',
    'sorterHeader' => '',
    /*'sortableAttributes'=>array(
        'price',
        'square',
        'house_floors',
        //'create_time'=>'Post Time',
    ),*/
));
?>

<?php

Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.fancybox.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css', "screen");

Yii::app()->clientScript->registerScript('apartments', '
    $(".fancybox").fancybox();
', CClientScript::POS_READY);
?>