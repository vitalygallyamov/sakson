<? if($news): ?>
<div class="block">
    <h3>Последние новости</h3>
    <? foreach($news as $n): ?>
    <div class="block half last_news">
        <div class="media_news">
            <a class="pull-left" href="/news/<?=$n->year?>/<?=$n->url?>">
                <img class="media-object" src="<?=$n->getImageUrl("normal")?>">
            </a>
            <div class="media-body">
                <div class="media_news_date"><?=$n->day?></div>
                <div class="media_news_month"><?=$n->month?></div>
                <h4><?=$n->name?></h4>
                <?=$n->preview_content?>...
            </div>
        </div>
    </div>
    <? endforeach; ?>
</div>
<? endif; ?>