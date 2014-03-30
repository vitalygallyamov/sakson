<?php
$this->breadcrumbs=array(
	'Lands'=>array('index'),
	$model->id,
);

<h1>View Lands #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'way_id',
		'city_id',
		'locality_id',
		'type_id',
		'state_id',
		'square',
		'material_id',
		'target_id',
		'price',
		'gllr_images',
		'seo_id',
		'user_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
