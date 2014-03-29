<?php

class mainMenuWidget extends CWidget {
    public function run(){
        $data["pages"] = Page::model()->findAllByAttributes(array("menu_public"=>"1"));

        $this->render("index", $data);
    }
}