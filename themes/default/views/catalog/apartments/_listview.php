<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'template' => '{sorter}<div class="clear"></div>{items}<div class="clear"></div><br><div class="info">{summary}</div>',
    'itemView'=>'apartments/_view',   // refers to the partial view named '_post'
    'summaryText' => 'НАЙДЕНО : {count}',
    'summaryCssClass' => '',
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