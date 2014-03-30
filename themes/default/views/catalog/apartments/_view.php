
<?  
    $square = '';
    if($data->square){
        $square = explode('.', $data->square);

        $square = $square[1] == '00' ? $square[0] : $data->square;
    }

    $added = explode(',', $data->added);
    $inCookie = $data->inCookies('apartment');
?>

<div class="media">
    <a class="pull-left" href="#">
        <img src="<?=$data->gallery->main ? $data->gallery->main->getUrl('small') : "http://placehold.it/140x180"?>">
        <?if($data->isNew()):?><div class="wtm new">new</div><?endif;?>
        <?if(in_array(Apartments::APART_HOT, $added)):?><div class="wtm hot">hot</div><?endif;?>
        <?if(in_array(Apartments::APART_VIP, $added)):?><div class="wtm vip">vip</div><?endif;?>
        <div class="wtm izb" data-id="<?=$data->id?>" data-type="apartment" title="<?=!$inCookie ? "Добавить в избранное" : "Удалить из избранного"?>">
            <input id="cfirst<?=$data->id?>" type="checkbox" name="izb<?=$data->id?>" <?=$inCookie ? 'checked' : ''?> hidden />
            <label for="cfirst<?=$data->id?>"></label>
        </div>
    </a>
    <div class="media-body">
        <span class="price"><?=CHtml::encode(number_format($data->price, 0, '', ' '))?> руб.</span>
        <div class="pixel" style="width:20px;height:2px;margin:5px 0px;"></div>
        <? if($data->area): ?>  
            <b>Район:</b> <?=CHtml::encode($data->area->name)?> <br>
        <? endif; ?>
        <? if($data->street): ?>
            <b>Адрес:</b> ул. <?=CHtml::encode($data->street->name)?> <br>
        <? endif; ?>
        <? if($data->house): ?> 
            <b>Дом:</b> <?=CHtml::encode($data->house)?> <br>
        <? endif; ?>
        <? if($data->wall): ?>  
            <b>Тип дома:</b> <?=CHtml::encode($data->wall->name)?> <br>
        <? endif; ?>
        <? if($data->square): ?>  
            <b>Площадь:</b> <?=CHtml::encode($square)?> <br>
        <? endif; ?>
        <? if($data->house_floors): ?>  
            <b>Этажность:</b> <?=CHtml::encode($data->house_floors)?> <br>
        <? endif; ?>
        <? if($data->floor): ?>  
            <b>Этаж:</b> <?=CHtml::encode($data->floor)?> <br>
        <? endif; ?>
    </div>
</div>