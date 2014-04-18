<?
    $inCookie = $data->inCookies('land');
    // $data->changeConfig();
    $square_house = '';
    if($data->square_house){
        $square_house = explode('.', $data->square_house);

        $square_house = $square_house[1] == '00' ? $square_house[0] : $data->square_house;
    }
?>
<div class="media media-item" data-id="<?=$data->id?>">
    <a class="pull-left" href="#">
        <img src="<?=$data->gallery->main ? $data->gallery->main->getUrl('small') : "http://placehold.it/140x180"?>">
        <?if($data->isNew()):?><div class="wtm new">new</div><?endif;?>
        <div class="wtm izb" data-id="<?=$data->id?>" data-type="land" title="<?=!$inCookie ? "Добавить в избранное" : "Удалить из избранного"?>">
            <input id="cfirst<?=$data->id.$data->uniqueId()?>" type="checkbox" name="izb<?=$data->id.$data->uniqueId()?>" <?=$inCookie ? 'checked' : ''?> hidden />
            <label for="cfirst<?=$data->id.$data->uniqueId()?>"></label>
        </div>
    </a>
    <div class="media-body">
        <span class="price"><?=CHtml::encode(number_format($data->price, 0, '', ' '))?> руб.</span>
        <div class="pixel" style="width:20px;height:2px;margin:5px 0px;"></div>
        <? if($data->way): ?>  
            <b>Направление:</b> <?=CHtml::encode($data->way->name)?> <br>
        <? endif; ?>
        <? if($data->city): ?>  
            <b>Город, район:</b> <?=CHtml::encode($data->city->name)?> <br>
        <? endif; ?>
        <? if($data->locality): ?>
            <b>Населенный пункт:</b> <?=CHtml::encode($data->locality->name)?> <br>
        <? endif; ?>
        <? if($data->square_house): ?>  
            <b>Площадь:</b> <?=CHtml::encode($square_house)?> <br>
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
            <? if($data->way): ?>  
                <b>Направление:</b> <?=CHtml::encode($data->way->name)?> <br>
            <? endif; ?>
            <? if($data->city): ?>  
                <b>Город, район:</b> <?=CHtml::encode($data->city->name)?> <br>
            <? endif; ?>
            <? if($data->locality): ?>
                <b>Населенный пункт:</b> <?=CHtml::encode($data->locality->name)?> <br>
            <? endif; ?>
            <? if($data->square_house): ?>  
                <b>Площадь:</b> <?=CHtml::encode($square_house)?> <br>
            <? endif; ?>
        </div>

        <div class="block3">
            <? if($data->material): ?>  
                <b>Материал:</b> <?=CHtml::encode($data->material->name)?> <br>
            <? endif; ?>
            <? if($data->target): ?>  
                <b>Назначение земли:</b> <?=CHtml::encode($data->target->name)?> <br>
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