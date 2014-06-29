<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
	array('label'=>'Корзина','url'=>array('cart'), 'visible' => Yii::app()->user->checkAccess('admin')),
);
?>

<h1><?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'business-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('business')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=> ($data->user_id == Yii::app()->user->id && !Yii::app()->user->checkAccess("admin")) ? "my" : "",
        "data-id" => $data->id
    )',
	'columns'=>array(
		array(
			'header' => 'Превью',
			'type' => 'raw',
			'value' => '$data->gallery->main ? TbHtml::imageRounded($data->gallery->main->getUrl("small")) : ""'
		),
		array(
			'header' => $model->getAttributeLabel('way_id'),
			'name'=>'way_id',
			'type'=>'raw',
			'value'=>'$data->way ? $data->way->name : ""',
			'filter'=>CHtml::listData( LandWays::all(), 'id', 'name')
		),
		array(
			'header' => $model->getAttributeLabel('locality_id'),
			'name'=>'locality_id',
			'type'=>'raw',
			'value'=>'$data->locality ? $data->locality->name : ""',
			'filter'=>CHtml::listData( LandLocalities::all(), 'id', 'name')
		),
		array(
			'header' => $model->getAttributeLabel('street_id'),
			'name' => 'street_id',
			'type' => 'raw',
			'value' => '$data->street ? $data->street->name : ""',
			'filter' => CHtml::listData(Streets::all(), 'id', 'name')
		),
		array(
			'header' => $model->getAttributeLabel('house_num'),
			'name' => 'house_num',
			'value' => '$data->isOwn() ? $data->house_num : ""'
		),
		array(
			'header' => $model->getAttributeLabel('room_num'),
			'name' => 'room_num',
			'value' => '$data->isOwn() ? $data->room_num : ""'
		),
		array(
			'header' => $model->getAttributeLabel('square'),
			'name' => 'square',
		),
		array(
			'header' => $model->getAttributeLabel('type_id'),
			'name'=>'type_id',
			'type'=>'raw',
			'value'=>'$data->getTypeName()',
			'filter'=>CHtml::listData( BusinessTypes::all(), 'id', 'type')
		),
		array(
			'header' => $model->getAttributeLabel('state_id'),
			'name'=>'state_id',
			'type'=>'raw',
			'value'=>'$data->state ? $data->state->name : ""',
			'filter'=>CHtml::listData( LandStates::all(), 'id', 'name')
		),
		array(
			'header' => $model->getAttributeLabel('price'),
			'name'=>'price',
			'type'=>'raw',
			'value'=>'number_format($data->price, 0, "", " ")." руб."'
		),
		array(
			'header' => $model->getAttributeLabel('user_id'),
			'name'=>'user_id',
			'type'=>'raw',
			'value'=>'$data->user ? $data->user->fio : "Не назначен"',
			'filter'=>AdminUser::getAgents(),
			'visible' => Yii::app()->user->checkAccess('admin')
		),
		array(
			'header' => $model->getAttributeLabel('status'),
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Business::getStatusAliases($data->status)',
			'filter'=>Business::getStatusAliases()
		),
		/*'sort',
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		),*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("business");', CClientScript::POS_END) ;?>