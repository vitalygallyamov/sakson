<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1><?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'lands-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('lands')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'name'=>'way_id',
			'type'=>'raw',
			'value'=>'$data->way ? $data->way->name : ""',
			'filter'=>CHtml::listData( LandWays::all(), 'id', 'name')
		),
		array(
			'name'=>'city_id',
			'type'=>'raw',
			'value'=>'$data->city ? $data->city->name : ""',
			'filter'=>CHtml::listData( LandCities::all(), 'id', 'name')
		),
		array(
			'name'=>'locality_id',
			'type'=>'raw',
			'value'=>'$data->locality ? $data->locality->name : ""',
			'filter'=>CHtml::listData( LandLocalities::all(), 'id', 'name')
		),
		array(
			'name'=>'type_id',
			'type'=>'raw',
			'value'=>'$data->type ? $data->type->name : ""',
			'filter'=>CHtml::listData( LandTypes::all(), 'id', 'name')
		),
		array(
			'name'=>'state_id',
			'type'=>'raw',
			'value'=>'$data->state ? $data->state->name : ""',
			'filter'=>CHtml::listData( LandStates::all(), 'id', 'name')
		),
		'square',
		array(
			'name'=>'material_id',
			'type'=>'raw',
			'value'=>'$data->material ? $data->material->name : ""',
			'filter'=>CHtml::listData( LandMaterials::all(), 'id', 'name')
		),
		array(
			'name'=>'target_id',
			'type'=>'raw',
			'value'=>'$data->target ? $data->target->name : ""',
			'filter'=>CHtml::listData( LandTargets::all(), 'id', 'name')
		),
		array(
			'name'=>'price',
			'type'=>'raw',
			'value'=>'$data->price." руб."'
		),
		// 'gallery_id',
		// 'seo_id',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Lands::getStatusAliases($data->status)',
			'filter'=>Lands::getStatusAliases()
		),
		// 'sort',
		// array(
		// 	'name'=>'create_time',
		// 	'type'=>'raw',
		// 	'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		// ),
		// array(
		// 	'name'=>'update_time',
		// 	'type'=>'raw',
		// 	'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		// ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("lands");', CClientScript::POS_END) ;?>