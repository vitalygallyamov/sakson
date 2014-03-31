<?  
    $square = '';
    if($data->square){
        $square = explode('.', $data->square);

        $square = $square[1] == '00' ? $square[0] : $data->square;
    }

    $added = explode(',', $data->added);
    $inCookie = $data->inCookies('apartment');
?>
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
            <b>Район:</b> Тюменский <br>
            <b>Адрес:</b> ул. Пролетарская <br>
            <div class="pixel" style="width:20px;height:2px;margin:8px 0px;"></div>
        </div>

        <div class="block2">
            <div class="object_id">
                <div class="hdr">
                    Объект
                </div>  
                <div class="id">
                    1500225
                </div>                                       
            </div>

            <i>Специалист</i><BR>
            Измайлова Лариса<BR>
            55-55-88

        </div>

        <div class="block3">
            <b>Район:</b> Тюменский <br>
            <b>Адрес:</b> ул. Пролетарская <br>
            <b>Дом:</b> 32 <br>
            <b>Тип дома:</b> Кирпич <br>
            
        </div>

        <div class="block3">
            <b>Район:</b> Тюменский <br>
            <b>Адрес:</b> ул. Пролетарская <br>
            <b>Дом:</b> 32 <br>
            <b>Тип дома:</b> Кирпич <br>
            
        </div>

        <div class="block4">
            <input id="cfirst1111" type="checkbox" name="first" checked hidden /><label for="cfirst1111">В избранное</label>
            <a href="#" class="but">Отправить на почту</a>
        </div>
        
    </div>
</div>