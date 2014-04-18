
<?  
    $square = '';
    if($data->square){
        $square = explode('.', $data->square);

        $square = $square[1] == '00' ? $square[0] : $data->square;
    }

    $added = explode(',', $data->added);
    $inCookie = $data->inCookies('apartment');

    $flat_num = 0;
    if($data->apartment_types){
        $t = $data->apartment_types->name;
        
        if($t == 4) $flat_num = '4+';
        else $flat_num = $data->apartment_type_id;
    }
?>

<div class="media media-item" data-id="<?=$data->id?>">
    <a class="pull-left" href="#">
        <img src="<?=$data->gallery->main ? $data->gallery->main->getUrl('small') : "http://placehold.it/140x180"?>">
        <?if($data->isNew()):?><div class="wtm new">new</div><?endif;?>
        <?if(in_array(Apartments::APART_HOT, $added)):?><div class="wtm hot">hot</div><?endif;?>
        <?if(in_array(Apartments::APART_VIP, $added)):?><div class="wtm vip">vip</div><?endif;?>
        <div class="wtm izb" data-id="<?=$data->id?>" data-type="apartment" title="<?=!$inCookie ? "Добавить в избранное" : "Удалить из избранного"?>">
            <input id="cfirst<?=$data->id.$data->uniqueId()?>" type="checkbox" name="izb<?=$data->id.$data->uniqueId()?>" <?=$inCookie ? 'checked' : ''?> hidden />
            <label for="cfirst<?=$data->id.$data->uniqueId()?>"></label>
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
        <? /*if($data->house): ?> 
            <b>Дом:</b> <?=CHtml::encode($data->house)?> <br>
        <? endif;*/ ?>
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
<?
$preview_id = $data->gallery->main ? $data->gallery->main->id : 0;
?>
<div class="media card">
    <a class="pull-left fancybox" rel="ap<?=$data->id?>" href="<?=$data->gallery->main ? $data->gallery->main->getUrl('big') : "http://placehold.it/140x180"?>">
        <img src="<?=$data->gallery->main ? $data->gallery->main->getUrl('small') : "http://placehold.it/140x180"?>">
        <?if($data->isNew()):?><div class="wtm new">new</div><?endif;?>
        <?if(in_array(Apartments::APART_HOT, $added)):?><div class="wtm hot">hot</div><?endif;?>
        <?if(in_array(Apartments::APART_VIP, $added)):?><div class="wtm vip">vip</div><?endif;?>
        
    </a>
    <?if($data->gallery->galleryPhotos):?>
        <?foreach ($data->gallery->galleryPhotos as $photo):?>
            <?if($preview_id == $photo->id) continue; ?>
            <a class="fancybox" rel="ap<?=$data->id?>" style="display: none;" href="<?=$photo->getUrl('big')?>"></a>
        <?endforeach;?>
    <?endif;?>
    <div class="media-body">
        <div class="block1">
            <span class="price"><span><?=CHtml::encode(number_format($data->price, 0, '', ' '))?></span> руб.</span>
            <br>
            <? if($data->price_1m): ?>  
                <b>Стоимость за 1 м<sup>2</sup>:</b> <?=CHtml::encode(number_format($data->price_1m, 0, '', ' '))?> руб.<br>
            <? endif; ?>
            <? /*if($data->price_agency): ?>
                <b>Стоимость услуг агенства:</b> <?=CHtml::encode(number_format($data->price_agency, 0, '', ' '))?> руб.<br>
            <? endif;*/ ?>
            <div class="pixel" style="width:20px;height:2px;margin:8px 0px;"></div>
        </div>

        <div class="block2">
            <div class="object_id">
                <div class="hdr">Объект</div>  
                <div class="id"><?=$data->id?></div>                                       
            </div>

            <i>Специалист</i><BR>
            <?=$data->user->fio?><BR><?=$data->user->phone?>

        </div>

        <div class="block3">
            <? if($data->area): ?>  
                <b>Район:</b> <?=CHtml::encode($data->area->name)?> <br>
            <? endif; ?>
            <? if($data->street): ?>
                <b>Адрес:</b> ул. <?=CHtml::encode($data->street->name)?> <br>
            <? endif; ?>
            <? /*if($data->house): ?> 
                <b>Дом:</b> <?=CHtml::encode($data->house)?> <br>
            <? endif;*/ ?>
            <? if($data->wall): ?>  
                <b>Тип дома:</b> <?=CHtml::encode($data->wall->name)?> <br>
            <? endif; ?>
            <? if($data->series): ?>  
                <b>Серия:</b> <?=CHtml::encode($data->series->name)?> <br>
            <? endif; ?>
        </div>

        <div class="block3">
            <? if($data->apartment_types): ?>  
                <b>Кол-во комнат:</b> <?=CHtml::encode($flat_num ? $flat_num : $data->apartment_types->name)?> <br>
            <? endif; ?>
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
                <b>Этажность:</b> <?=CHtml::encode($data->house_floors)?> <br>
            <? endif; ?>
            
        </div>

        <div class="block4">
            <div class="izb-detail" data-id="<?=$data->id?>" data-type="apartment">
                <input id="cfirst<?=$data->id.$data->uniqueId()?>d" type="checkbox" name="izb<?=$data->id.$data->uniqueId()?>d" <?=$inCookie ? 'checked' : ''?> hidden />
                <label for="cfirst<?=$data->id.$data->uniqueId()?>d">В избранное</label>
            </div>
            <!-- <a href="#" class="but">Отправить на почту</a> -->
        </div>
        
    </div>
    <div class="clear"></div>
    <?if($data->desc):?>
    <div class="object-desc"><strong>Описание: </strong><?=CHtml::encode($data->desc)?></div>
    <?endif;?>
</div>