<?php
$this->widget('zii.widgets.CListView', array(
    'id' => 'catalog-list',
    'dataProvider'=>$dataProvider,
    'template' => '{sorter}<div class="clear"></div>{items}<div class="clear"></div><br>{pager}<div class="info">{summary}</div>',
    'itemView'=>'lands/_view',   // refers to the partial view named '_post'
    'summaryText' => "<div class=\"left\">НАЙДЕНО : {count}</div><div class=\"right\">НА СТРАНИЦЕ : {start}-{end}</div>",
    'summaryCssClass' => '',
    'pagerCssClass' => 'pager',
    'cssFile' => false,
    'pager' => array(
        'nextPageLabel' => CHtml::image($this->getAssetsUrl().'/images/pager_to_right.png'),
        'prevPageLabel' => CHtml::image($this->getAssetsUrl().'/images/pager_to_left.png'),
        'header' => '',
        'cssFile'=>false,
    ),
    // 'sorterCssClass' => 'sortblock',
    'sorterHeader' => '',
    'sortableAttributes'=>array(
        'price',
        'square_house',
        //'create_time'=>'Post Time',
    ),
));
?>

<?php

Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.fancybox.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox.css', "screen");

Yii::app()->clientScript->registerScript('apartments', '
    $(".fancybox").fancybox({
        padding: 0
    });
', CClientScript::POS_READY);
?>