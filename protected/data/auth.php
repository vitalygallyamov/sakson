<?php
return array(
    /*'reader' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Can only read a post',
        'bizRule'=>'',
        'data'=>''
   ),*/
 
    'agent' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Агент по недвижимости',
        'bizRule'=>'',
        'data'=>''
    ),
 
    'admin' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Администратор',
        'children'=>array(
            'agent'
        ),
        'bizRule'=>'',
        'data'=>''
   )
);