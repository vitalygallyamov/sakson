<? if($news):
    foreach($news as $n):
    ?>
<div class="new">
    <div class="date"><?=$n->day?></div>
    <div class="month"><?=$n->month?></div>
    <h4><?=$n->name?></h4>
    <p><?=$n->preview_content?></p>
    <a href="/news/view/id/<?=$n->id?>" class="button">Подробнее</a>
</div>
<?
    endforeach;
endif; ?>