<div class="line second_content">
    <div class="line995px">
        <div class="line_content">
            <div class="news">
                <div class="left_col">
                    <? if($photos): ?>
                    <div class="photos">
                        <div class="big">
                            <img src="<?=$photos[0]->getUrl("normal")?>" class="border">
                        </div>
                        <div class="thumbs">
                            <? foreach($photos as $p): ?>
                                <img src="<?=$p->getUrl("small")?>" rel="<?=$p->getUrl("normal")?>">
                            <? endforeach; ?>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                $(".thumbs img").bind("click", function(e){
                                    scr = $(this).attr("rel");
                                    $(".big img").attr("src",scr);
                                });
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
                    <? $this->widget("ext.news.newsWidget", array("right"=>true)); ?>
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
        </div>
    </div>
</div>