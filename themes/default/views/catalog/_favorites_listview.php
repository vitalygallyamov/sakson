<?php
$this->widget('zii.widgets.CListView', array(
    'id' => 'catalog-list',
    'dataProvider'=>$dataProvider,
    'template' => '{sorter}<div class="clear"></div>{items}<div class="clear"></div><br><a href="#" class="but to_mail">Отправить на почту</a>{pager}<div class="info">{summary}</div>',
    'itemView'=>'apartments/_view',   // refers to the partial view named '_post'
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
        'square',
        'house_floors',
        //'create_time'=>'Post Time',
    ),
));
?>