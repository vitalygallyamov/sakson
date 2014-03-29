<div class="line submenu">
    <div class="line995px submenu_dark">
        <? if(is_array($subMenuItems) && count($subMenuItems) > 0): ?>
        <div class="line_content">
            <ul>
                <? foreach($subMenuItems as $item): ?>
                <li><a href="<?=$item["url"]?>"<?=($item["active"]) ? 'class="active"':''?>><?=$item["name"]?></a></li>
                <? endforeach; ?>
            </ul>
        </div>
        <? endif; ?>
    </div>
</div>