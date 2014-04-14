<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1>Удаленные объекты</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'lands-cart',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('apartments')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
        "data-id" => $data->id
    )',
	'columns'=>array(
		array(
			'header' => 'Превью',
			'type' => 'raw',
			'value' => '$data->gallery->main ? TbHtml::imageRounded($data->gallery->main->getUrl("small")) : ""'
		),
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
		/*array(
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
		),*/
		array(
			'name'=>'price',
			'type'=>'raw',
			'value'=>'$data->price." руб."'
		),
		array(
			'name' => 'delete_reason',
			'type' => 'raw',
			'value' => 'Apartments::deleteReasons($data->delete_reason)',
			'filter' => Apartments::deleteReasons()
		),
		/*'floor',
		'house_floors',
		'square',
		'price',*/
		array(
			'name' => 'status',
			'type' => 'raw',
			//'value' => 'CHtml::link("Удалить из корзины", "#", array("class" => "change", "data-id" => $data->id))'
			'value' => 'CHtml::activeDropDownList($data, "status", Apartments::getStatusAliasesCart(), array("class" => "change", "data-id" => $data->id))',
			'filter' => false
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{delete}',
		),
	),
)); ?>

<script>
$('#lands-cart').on('change', '.change', function(e){
	if(confirm('Вы уверены?')){
		var $this = $(this),
			val = $(this).val(),
			id = $(this).data('id');

		$.ajax({
			url: '/admin/lands/changeStatus',
			data: {id:id, val:val},
			success: function(){
				jQuery('#lands-cart').yiiGridView('update');
			}
		})
	}
});
</script>

<?php //if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("apartments");', CClientScript::POS_END) ;?>