<?php

class sliderWidget extends CWidget {
    public function run(){
        $data["slides"] = Slider::model()->findAll("status=".Slider::STATUS_PUBLISH);
        $this->render("index", $data);
    }
}