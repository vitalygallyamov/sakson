<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
	array('label'=>'Корзина','url'=>array('cart'), 'visible' => Yii::app()->user->checkAccess('admin')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<div class="search-form">
<?php $this->renderPartial('_search',array(
    'model' => $filter,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'apartments-grid',
	'dataProvider'=>$filterData ? $filterData : $model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('apartments')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>$data->agent_id == Yii::app()->user->id ? "my" : "",
        "data-id" => $data->id
    )',
	'columns'=>array(
		array(
			'header' => 'Превью',
			'type' => 'raw',
			'value' => '$data->gallery->main ? TbHtml::imageRounded($data->gallery->main->getUrl("small")) : ""'
		),
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
		array(
			'name' => 'house',
			'type' => 'raw',
			'value' => '$data->checkAccess() ? $data->house : ""'
		),
		array(
			'name' => 'room_num',
			'type' => 'raw',
			'value' => '$data->checkAccess() ? $data->room_num : ""'
		),
		array(
			'name' => 'category_id',
			'type' => 'raw',
			'value' => '$data->category->name',
			'filter' => CHtml::activeDropDownList($model,'category_id', array('' => 'Нет') + CHtml::listData(Categories::all(), 'id', 'name'))
		),
		'floor',
		'house_floors',
		'square',
		'price',
		array(
			'name'=>'agent_id',
			'type'=>'raw',
			'value'=>'$data->user->fio',
			'filter'=>AdminUser::getAgents(),
			'visible' => Yii::app()->user->checkAccess('admin')
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Apartments::getStatusAliases($data->status)',
			'filter'=>Apartments::getStatusAliases()
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			// 'template' => '{update} {delete}',
			'buttons' => array(
				'delete' => array(
					'click' => 'js:function(){
						var id = jQuery(this).closest("tr").data("id");

						jQuery.ajax({
							url: "/admin/apartments/getDeleteForm",
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
			url: "/admin/apartments/getDeleteForm/id/" + $this.data('id'),
			type: 'POST',
			data: $form.serialize(),
			success: function(data){
				if(data == 'ok'){
					jQuery('#apartments-grid').yiiGridView('update');
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

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("apartments");', CClientScript::POS_END) ;?>