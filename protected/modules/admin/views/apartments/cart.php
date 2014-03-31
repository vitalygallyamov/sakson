<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1>Удаленные квартиры</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'apartments-cart',
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
		/*array(
			'header' => 'Название',
			'type' => 'raw',
			'value' => '$data->area->name.", ул. ".$data->street->name.", ".$data->house'
		),*/
		array(
			'name' => 'apartment_type_id',
			'type' => 'raw',
			'value' => '$data->apartment_types->name',
			'filter' => false
		),
		array(
			'name' => 'area_id',
			'type' => 'raw',
			'value' => '$data->area->name',
			'filter' => false
		),
		array(
			'name' => 'street_id',
			'type' => 'raw',
			'value' => '$data->street->name',
			'filter' => false
		),
		array(
			'name' => 'house',
			'filter' => false
		),
		
		array(
			'name' => 'category_id',
			'type' => 'raw',
			'value' => '$data->category->name',
			'filter' => false
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
$('#apartments-cart').on('change', '.change', function(e){
	if(confirm('Вы уверены?')){
		var $this = $(this),
			val = $(this).val(),
			id = $(this).data('id');

		$.ajax({
			url: '/admin/apartments/changeStatus',
			data: {id:id, val:val},
			success: function(){
				jQuery('#apartments-cart').yiiGridView('update');
			}
		})
	}
});
</script>

<?php //if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("apartments");', CClientScript::POS_END) ;?>