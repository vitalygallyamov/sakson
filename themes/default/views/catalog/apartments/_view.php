
<?  
    $square = '';
    if($data->square){
        $square = explode('.', $data->square);

        $square = $square[1] == '00' ? $square[0] : $data->square;
    }

    $added = explode(',', $data->added);
    $inCookie = $data->inCookies('apartment');
?>

<div class="media" data-id="<?=$data->id?>">
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
<? /*detail view*/?>
<div class="media card">
    <a class="pull-left" href="#">
        <img src="<?=$data->gallery->main ? $data->gallery->main->getUrl('small') : "http://placehold.it/140x180"?>">
        <?if($data->isNew()):?><div class="wtm new">new</div><?endif;?>
        <?if(in_array(Apartments::APART_HOT, $added)):?><div class="wtm hot">hot</div><?endif;?>
        <?if(in_array(Apartments::APART_VIP, $added)):?><div class="wtm vip">vip</div><?endif;?>
        
    </a>
    <div class="media-body">
        <div class="block1">
            <span class="price"><span><?=CHtml::encode(number_format($data->price, 0, '', ' '))?></span> руб.</span>
            <br>
            <? if($data->price_1m): ?>  
                <b>Стоимость за 1 м<sup>2</sup>:</b> <?=CHtml::encode(number_format($data->price_1m, 0, '', ' '))?> руб.<br>
            <? endif; ?>
            <? if($data->price_agency): ?>
                <b>Стоимость услуг агенства:</b> <?=CHtml::encode(number_format($data->price_agency, 0, '', ' '))?> руб.<br>
            <? endif; ?>
            <div class="pixel" style="width:20px;height:2px;margin:8px 0px;"></div>
        </div>

        <div class="block2">
            <div class="object_id">
                <div class="hdr">Объект</div>  
                <div class="id"><?=$data->id?></div>                                       
            </div>

            <i>Специалист</i><BR>
            Измайлова Лариса<BR>
            55-55-88

        </div>

        <div class="block3">
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
            <? if($data->series): ?>  
                <b>Серия:</b> <?=CHtml::encode($data->series->name)?> <br>
            <? endif; ?>
        </div>

        <div class="block3">
            <? if($data->square): ?>  
                <b>Площадь:</b> <?=CHtml::encode($square)?> <br>
            <? endif; ?>
            <? if($data->kitchen_area): ?>  
                <b>Кухня:</b> <?=CHtml::encode($data->kitchen_area)?> <br>
            <? endif; ?>
            <? if($data->floor): ?>  
                <b>Этаж:</b> <?=CHtml::encode($data->floor)?> <br>
            <? endif; ?>
            <? if($data->house_floors): ?>  
                <b>Этаж:</b> <?=CHtml::encode($data->house_floors)?> <br>
            <? endif; ?>
            
        </div>

        <div class="block4">
            <div class="izb-detail" data-id="<?=$data->id?>" data-type="apartment">
                <input id="cfirst<?=$data->id?>d" type="checkbox" name="izb<?=$data->id?>d" <?=$inCookie ? 'checked' : ''?> hidden /><label for="cfirst<?=$data->id?>d">В избранное</label>
            </div>
            <a href="#" class="but">Отправить на почту</a>
        </div>
        
    </div>
</div>