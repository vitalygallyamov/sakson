<?php
class partnersWidget extends CWidget {
    public function run() {
        $data["partners"] = Partner::model()->findAllByAttributes(array("status"=>Partner::STATUS_PUBLISH));
        $this->render('index', $data);
    }
}