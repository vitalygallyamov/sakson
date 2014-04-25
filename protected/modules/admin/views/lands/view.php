<?php
$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1>Объект #<?=$model->id?></h1>

<?if($model->gallery->galleryPhotos): ?>
<h3>Фотографии квартиры</h3>
<div class="row-fluid">
	<?foreach ($model->gallery->galleryPhotos as $photo):?>
		<a class="fancybox" rel="view" href="<?=$photo->getUrl('big')?>"><img src="<?=$photo->getUrl('small')?>" alt=""></a>
	<?endforeach;?>
</div><br><br>
<?endif;?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name' => 'way_id',
			'type'=>'raw',
			'value' => $model->way ? $model->way->name : false
		),
		array(
			'name' => 'locality_id',
			'type'=>'raw',
			'value' => $model->locality ? $model->locality->name : false
		),
		array(
			'name' => 'street_id',
			'type'=>'raw',
			'value' => $model->street ? $model->street->name : false
		),
		array(
			'name' => 'house_num',
			'visible' => $model->isOwn()
		),
		array(
			'name' => 'type_id',
			'type'=>'raw',
			'value' => $model->type ? $model->type->name : false
		),
		array(
			'name' => 'state_id',
			'type'=>'raw',
			'value' => $model->state ? $model->state->name : false
		),
		array(
			'name' => 'material_id',
			'type'=>'raw',
			'value' => $model->material ? $model->material->name : false
		),
		'price',
		'distance',
		'square_house',
		'square_place',
		'phone_own',
		'desc',
		'comment',
	),
)); ?>

<?php
Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.css', "screen");

Yii::app()->clientScript->registerScript('parts', '
    $(".fancybox").fancybox();
', CClientScript::POS_READY);
?>