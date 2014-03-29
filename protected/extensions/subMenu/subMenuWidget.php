<?php
class subMenuWidget extends CWidget {
    public $subMenuItems;

    public function run(){
        $data["subMenuItems"] = $this->subMenuItems;
        $this->render("index", $data);
    }
}