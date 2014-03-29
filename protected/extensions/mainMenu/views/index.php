<div class="line top_menu">
    <div class="line995px">
        <div class="line_content">
            <? if($pages): ?>
            <ul class="left">
                <? foreach($pages as $p): ?>
                    <li><a href="<?=$p->url?>" class="<?=$p->active?>"><?=$p->show_name?></a></li>
                <? endforeach; ?>
            </ul>
            <? endif; ?>

            <ul class="right">
                <li><a href="#">Вход</a></li>
            </ul>
        </div>
    </div>
</div>