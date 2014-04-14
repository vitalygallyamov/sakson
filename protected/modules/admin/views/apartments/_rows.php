<?
	if(is_string($model->added)){
		$model->added = explode(',', $model->added);
	}
?>

	<?php echo $form->dropDownListControlGroup($model,'apartment_type_id', CHtml::listData(ApartmentTypes::all(), 'id', 'name')); ?>

	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('area_id')?></label>
		<div class="controls">
			<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'area_id',
				'data' => CHtml::listData(Areas::all(), 'id', 'name'),
				'pluginOptions' => array(
				    'width' => '40%',
					)
				));?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('street_id')?></label>
		<div class="controls">
			<?php
				$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
					'model' => $model,
					'attribute' => 'street_id',
					'asDropDownList' => false,
					'pluginOptions' => array(
						'width' => '40%',
						'ajax' => array(
							'url' => '/admin/streets/allJson',
							'dataType' => 'json',
							'quietMillis' => 300,
							'data' => 'js: function(term, page){return {q: term};}',
							'results' => 'js: function(data, page){return { results: data };}'
						),
						'initSelection' => 'js:function (element, callback) {var id=$(element).val(); $.getJSON("/admin/streets/getOneById", {id: id}, function(data) { callback(data); }) }'
					)
				));
			?>
			<?php /*$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'street_id',
				'data' => CHtml::listData(Streets::all(), 'id', 'name'),
				'pluginOptions' => array(
				    'width' => '40%'
					)
				));*/?>
		</div>
	</div>

	<?if($model->checkAccess()):?>
	<?php echo $form->textFieldControlGroup($model,'house',array('maxlength'=>20)); ?>
	<?php echo $form->textFieldControlGroup($model,'room_num'); ?>
	<?endif;?>

	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('category_id')?></label>
		<div class="controls">
			<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'category_id',
				'data' => CHtml::listData(Categories::all(), 'id', 'name'),
				'pluginOptions' => array(
				    'width' => '40%',
					)
				));?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'floor'); ?>

	<?php echo $form->textFieldControlGroup($model,'house_floors'); ?>
	
	<?php echo $form->textFieldControlGroup($model, 'square', array('append' => 'кв.м.', 'maxlength'=>8, 'class' => 'square')); ?>

	<?php echo $form->textFieldControlGroup($model, 'kitchen_area', array('append' => 'кв.м.', 'maxlength'=>8)); ?>
	
	<?php echo $form->dropDownListControlGroup($model,'walls_type_id', CHtml::listData(WallTypes::all(), 'id', 'name')); ?>

	<div class="control-group">
		<label class="control-label" for="Parts_category_id"><?=$model->getAttributeLabel('series_id')?></label>
		<div class="controls">
			<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'series_id',
				'data' => CHtml::listData(Series::all(), 'id', 'name'),
				'pluginOptions' => array(
				    'width' => '40%',
					)
				));?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'price',array('append' => '.00 руб.','maxlength'=>10, 'class' => 'calc-price')); ?>

	<?php echo $form->textFieldControlGroup($model,'price_1m',array('append' => '.00 руб.','maxlength'=>10, 'class' => 'price-1m', 'disabled' => 'disabled')); ?>
	<?php echo $form->hiddenField($model,'price_1m',array('class' => 'price-1m-true')); ?>

	<?php echo $form->textFieldControlGroup($model,'phone_own'); ?>

	<?php echo $form->textFieldControlGroup($model,'limit', array('maxlength'=>30)); ?>

	<?php echo $form->textFieldControlGroup($model,'life_time_house'); ?>

	<?php echo $form->textAreaControlGroup($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	
	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_photos'); ?>
		<?php if ($model->galleryBehaviorPhotos->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorPhotos->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<?php echo $form->hiddenField($model,'agent_id',array('class'=>'span8', 'value' => Yii::app()->user->id)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Apartments::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php echo $form->checkBoxListControlGroup($model, 'added', Apartments::addedList()); ?>

<script>
	jQuery('.calc-price').on('keyup', function(){
		var square = jQuery('.square').val(),
			price = jQuery(this).val();

		if(square){
			jQuery('.price-1m, .price-1m-true').val(Math.round(price / square));
		}
	});
</script>