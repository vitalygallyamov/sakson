<?php

class PageController extends AdminController
{
    public $layout = '/layouts/custom';

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                // 'actions' => array('list', 'create', 'update', ''),
                'roles'=>array('admin'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
}
