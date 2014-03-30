<div class="line slider">
    <div class="line995px">
        <div class="line_content">
            <!-- slider -->
            <div class="jcarousel-wrapper">
                <? if($slides): ?>
                <div class="jcarousel">
                    <ul>
                        <? foreach($slides as $s): ?>
                        <li>
                            <div class="header_slider">
                                <img src="<?=$s->getImageUrl("normal")?>"><br>
                                <p><?=$s->content?></p>
                            </div>
                        </li>
                        <? endforeach; ?>
                    </ul>
                </div>

                <a href="#" class="jcarousel-control-prev"><img src="/media/images/slider_to_left.png"></a>
                <a href="#" class="jcarousel-control-next"><img src="/media/images/slider_to_right.png"></a>

                <center><p class="jcarousel-pagination"></p></center>
                <? endif; ?>
            </div>

        </div>
    </div>
</div>