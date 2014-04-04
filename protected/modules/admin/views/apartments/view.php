<h1>Квартира #<?=$model->id?></h1>

<?if($model->gallery->galleryPhotos):?>
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
			'name' => 'apartment_type_id',
			'type'=>'raw',
			'value' => $model->apartment_types ? $model->apartment_types->name : false
		),
		array(
			'name' => 'area_id',
			'type'=>'raw',
			'value' => $model->area ? $model->area->name : false
		),
		array(
			'name' => 'street_id',
			'type'=>'raw',
			'value' => $model->street ? $model->street->name : false
		),
		array(
			'name' => 'house',
			'visible' => $model->isOwn()
		),
		array(
			'name' => 'room_num',
			'visible' => $model->isOwn()
		),
		array(
			'name' => 'category_id',
			'type'=>'raw',
			'value' => $model->category ? $model->category->name : false
		),
		'floor',
		'house_floors',
		'square',
		'kitchen_area',
		array(
			'name' => 'walls_type_id',
			'type'=>'raw',
			'value' => $model->wall ? $model->wall->name : false
		),
		array(
			'name' => 'series_id',
			'type'=>'raw',
			'value' => $model->series ? $model->series->name : false
		),
		'price',
		'price_1m',
		array(
			'name' => 'series_id',
			'type'=>'raw',
			'value' => $model->series ? $model->series->name : false
		),
		array(
			'name' => 'phone_own',
			'visible' => $model->isOwn()
		),
		array(
			'name' => 'life_time_house',
			'visible' => $model->isOwn()
		),
	),
)); ?>

<?php
Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/js/fancybox/source/jquery.fancybox.css', "screen");

Yii::app()->clientScript->registerScript('parts', '
    $(".fancybox").fancybox();
', CClientScript::POS_READY);
?>