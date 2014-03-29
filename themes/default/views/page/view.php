<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->name,
);

<h1>View Page #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'menu_name',
		'menu_public',
		'wswg_content',
		'seo_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
