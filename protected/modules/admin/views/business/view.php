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
			'name' => 'room_num',
			'visible' => $model->isOwn()
		),
		array(
			'name' => 'type_id',
			'type'=>'raw',
			'value' => $model->getTypeName()
		),
		'square',
		array(
			'name' => 'state_id',
			'type'=>'raw',
			'value' => $model->state ? $model->state->name : false
		),
		array(
			'name' => 'price',
			'type'=>'raw',
			'value' => number_format($model->price, 0, '', ' ').' руб.'
		),
		'limit',
		'phone_own',
		'desc',
		'comment',
		array(
			'name' => 'user_id',
			'value' => $model->user ? $model->user->fio." (тел. ".$model->user->phone.")" : ""
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