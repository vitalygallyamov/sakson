<div class="news">
    <div class="left_col">
        <? if($photos): ?>
        <div class="photos">
            <div class="big">
                <a class="fancybox" title="<?=$photos[0]->name?>" rel="news" href="<?=$photos[0]->getUrl("big")?>"><img src="<?=$photos[0]->getUrl("normal")?>" class="border"></a>
            </div>
            <div class="thumbs">
                <? foreach($photos as $k => $p):
                    if($k == "0")
                        continue;
                    ?>
                    <a class="fancybox" title="<?=$p->name?>" rel="news" href="<?=$p->getUrl("big")?>"><img src="<?=$p->getUrl("small")?>" rel="<?=$p->getUrl("normal")?>"></a>
                <? endforeach; ?>
            </div>

            <script type="text/javascript">
                $(document).ready(function(){
                    $(".fancybox").fancybox();
//                    $(".thumbs img").bind("click", function(e){
//                        scr = $(this).attr("rel");
//                        $(".big img").attr("src",scr);
//                    });
                });
            </script>
        </div>
        <? endif; ?>

    </div>

    <div class="center_col">
        <div class="date"><?=$model->day?></div>
        <div class="month"><?=$model->month?></div>
        <h4><?=$model->name?></h4>
        <?=$model->wswg_content?>
        <div class="pixel" style="width:100px;height:2px;margin:10px 0px;"></div>
        <i><?=$model->author?></i>
    </div>

    <div class="right_col">
        <?
        $this->widget("zii.widgets.CListView", array(
            'id'=>'news-list',
            'dataProvider'=>$dataProvider,
            'template'=>'{items}{pager}',
            'itemView'=>'_view',
            'summaryCssClass' => '',
            'pagerCssClass' => 'pager news-pager',
            'pager' => array(
                'nextPageLabel' => CHtml::image($this->getAssetsUrl().'/images/pager_to_right.png'),
                'prevPageLabel' => CHtml::image($this->getAssetsUrl().'/images/pager_to_left.png'),
                'header' => '',
                'cssFile'=>false,
            ),
        ));
        ?>
    </div>
</div>
<!--div class="left_col">
    qweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qwe

</div>

<div class="center_col">
    qweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe


</div>

<div class="right_col">
    qweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qweqweqwe qwe qwe qwe qwe


</div-->
<div class="clear"></div>