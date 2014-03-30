<div class="foo_dark">
    <div class="line995px">
        <div class="line_content">
            <div class="block half">
                <div class="adr">
                    <?=isset($this->settings["address"]) ? $this->settings["address"] : ''?>
                </div>
                <div class="phones">
                     <?=isset($this->settings["phone"]) ? $this->settings["phone"] : ''?>
                </div>
            </div>
            <div class="block half">
                <ul class="social">
                    <li>
                        <a href="<?=isset($this->settings["fb_link"]) ? $this->settings["fb_link"] : ''?>"><img src="<?=$this->getAssetsUrl()?>/images/social/1.png"></a>
                    </li>
                    <li>
                        <a href="<?=isset($this->settings["tw_link"]) ? $this->settings["tw_link"] : ''?>"><img src="<?=$this->getAssetsUrl()?>/images/social/2.png"></a>
                    </li>
                    <li>
                        <a href="<?=isset($this->settings["vk_link"]) ? $this->settings["vk_link"] : ''?>"><img src="<?=$this->getAssetsUrl()?>/images/social/3.png"></a>
                    </li>
                    <li>
                        <a href="<?=isset($this->settings["sk_link"]) ? $this->settings["sk_link"] : ''?>"><img src="<?=$this->getAssetsUrl()?>/images/social/4.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>