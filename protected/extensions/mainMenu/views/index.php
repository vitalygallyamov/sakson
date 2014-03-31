<div class="line top_menu">
    <div class="line995px">
        <div class="line_content">
            <? if($pages): ?>
            <ul class="left">
                <li><a href="/">Главная</a></li>
                <li><a href="/page/about">О компании</a></li>
                <li><a href="/news">Новости</a></li>
                <li><a href="/catalog">Каталог</a></li>
                <? /*foreach($pages as $p): ?>
                    <li><a href="<?=$p->url?>" class="<?=$p->active?>"><?=$p->show_name?></a></li>
                <? endforeach; */?>
            </ul>
            <? endif; ?>

            <ul class="right">
                <li><a href="/admin">Вход</a></li>
            </ul>
        </div>
    </div>
</div>