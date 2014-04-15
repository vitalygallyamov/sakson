<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
	array('label'=>'Корзина','url'=>array('cart'), 'visible' => Yii::app()->user->checkAccess('admin')),
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
        "class"=>$data->user_id == Yii::app()->user->id ? "my" : "",
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
			// 'template' => '{update} {delete}',
			'buttons' => array(
				'delete' => array(
					'click' => 'js:function(){
						var id = jQuery(this).closest("tr").data("id");

						jQuery.ajax({
							url: "/admin/lands/getDeleteForm",
							data: {id: id},
							success: function(data){
								jQuery("#modal").html(data);
								jQuery("#confirmDelete").modal("show");
							}
						});
						return false;
					}'
				)
			)
		),
	),
)); ?>

<div id="modal"></div>

<script>
	jQuery('#modal').on('click', '.save-delete-form', function(){
		var $this = jQuery(this),
			$form = $this.closest('#modal').find('form');

		$this.button("loading");
		jQuery.ajax({
			url: "/admin/lands/getDeleteForm/id/" + $this.data('id'),
			type: 'POST',
			data: $form.serialize(),
			success: function(data){
				if(data == 'ok'){
					jQuery('#lands-grid').yiiGridView('update');
					jQuery("#confirmDelete").modal("hide");
				}else{
					jQuery("#confirmDelete").modal("hide");
					jQuery("#modal").html(data);
					jQuery("#confirmDelete").modal("show");
				}
			}
		});
	});
</script>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("lands");', CClientScript::POS_END) ;?>