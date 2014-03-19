<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'apartments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('apartments')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		/*array(
			'header' => 'Название',
			'type' => 'raw',
			'value' => '$data->area->name.", ул. ".$data->street->name.", ".$data->house'
		),*/
		array(
			'name' => 'apartment_type_id',
			'type' => 'raw',
			'value' => '$data->apartment_types->name',
			'filter' => CHtml::activeDropDownList($model,'apartment_type_id', array('' => 'Нет') + CHtml::listData(ApartmentTypes::all(), 'id', 'name'))
		),
		array(
			'name' => 'area_id',
			'type' => 'raw',
			'value' => '$data->area->name',
			'filter' => CHtml::activeDropDownList($model,'area_id', array('' => 'Нет') + CHtml::listData(Areas::all(), 'id', 'name'))
		),
		array(
			'name' => 'street_id',
			'type' => 'raw',
			'value' => '$data->street->name',
			'filter' => CHtml::activeDropDownList($model,'street_id', array('' => 'Нет') + CHtml::listData(Streets::all(), 'id', 'name'))
		),
		'house',
		array(
			'name' => 'category_id',
			'type' => 'raw',
			'value' => '$data->category->name',
			'filter' => CHtml::activeDropDownList($model,'category_id', array('' => 'Нет') + CHtml::listData(Categories::all(), 'id', 'name'))
		),
		'floor',
		'house_floors',
		'square',
/*		'kitchen_area',
		'walls_type_id',
		'series_id',
		'price_1m',
		'price_agency',
		'price',*/
/*		'gllr_photos',
		'agent_id',
		'seo_id',*/
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Apartments::getStatusAliases($data->status)',
			'filter'=>Apartments::getStatusAliases()
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

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("apartments");', CClientScript::POS_END) ;?>