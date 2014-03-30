<? if($partners): ?>
<div class="line index_content_light">
    <div class="line995px">
        <div class="line_content">
            <div class="block">
                <h3>Наши партнеры</h3>
                <div class="block_center partners">
                    <? foreach($partners as $p): ?>
                    <img src="<?=$p->getImageUrl('normal')?>" id="partner_<?=$p->id?>" class="partner gray">
                    <? endforeach; ?>
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
                            src = $(this).attr('src');

                            $(".partners img").addClass('gray');
                            $(this).removeClass("gray");

//                            $("#"+id).attr("src","/media/images/partners/"+id+"_color.png");
//                            $("#"+$("#old_id").val()).attr("src","/media/images/partners/"+$("#old_id").val()+".png");
                            $(".partner_container").hide(100);
                            $("#container_"+id).show(200);
                            $("#old_id").val(id);
                        });

                    });

                </script>
                <? foreach($partners as $p): ?>
                    <div id="container_partner_<?=$p->id?>" class="partner_container">
                        <h4><?=$p->name?></h4>
                        <p><?=$p->desc?></p>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <? endif; ?>