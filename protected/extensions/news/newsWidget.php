<?php

class newsWidget extends CWidget {
    public $right = false;

    public function run(){
        $data["news"] = $this->loadModel();

        if($this->right){
            $this->render("right", $data);
            return;
        }

        $this->render("index", $data);
    }

    public function loadModel(){
        $criteria = new CDbCriteria;
        $criteria->addCondition("status=".News::STATUS_PUBLISH);
        $criteria->order = "dt_date DESC";
        $criteria->limit = 2;
        if($this->right)
            $criteria->limit = 5;
        return News::model()->findAll($criteria);
    }
}