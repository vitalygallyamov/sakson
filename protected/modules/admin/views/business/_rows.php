	<?php echo $form->dropDownListControlGroup($model,'way_id', CHtml::listData( LandWays::all(), 'id', 'name')); ?>

	<?php echo $form->dropDownListControlGroup($model,'locality_id', CHtml::listData( LandLocalities::all(array('order' => 'name')), 'id', 'name')); ?>

	<div class="control-group<?=$model->hasErrors('street_id') ? ' error' : ''?>">
		<?=$form->labelEx($model, 'street_id')?>
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
			<?=$form->error($model, 'street_id', array('type' => TbHtml::HELP_TYPE_BLOCK))?>
		</div>
	</div>

	<?php echo $form->textFieldControlGroup($model,'house_num'); ?>

	<?php echo $form->textFieldControlGroup($model,'room_num'); ?>

	<?php echo $form->textFieldControlGroup($model,'square',array('maxlength'=>8)); ?>

	<?php echo $form->dropDownListControlGroup($model,'type_id', CHtml::listData(BusinessTypes::getRootTypes(), 'id', 'type'), array('class' => 'sub-types-select')); ?>

	<div class="sub-types">
		<?php if($model->sub_type_id): ?>
		<?php echo $form->dropDownListControlGroup($model,'sub_type_id', CHtml::listData($model->type->children, 'id', 'type')); ?>
		<?php endif; ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model,'state_id', CHtml::listData( LandStates::all(), 'id', 'name')); ?>

	<?php echo $form->textFieldControlGroup($model,'price',array('maxlength'=>10)); ?>

	<?php echo $form->textFieldControlGroup($model,'limit',array('maxlength'=>30)); ?>

	<?php echo $form->textFieldControlGroup($model,'phone_own',array('maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gllr_images'); ?>
		<?php if ($model->galleryBehaviorImages->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('appext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryBehaviorImages->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<?php echo $form->textAreaControlGroup($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Business::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php if(Yii::app()->user->checkAccess('admin')){?>
		<?php echo $form->dropDownListControlGroup($model, 'user_id', AdminUser::getAgents()); ?>
	<?php }else{?>
		<?php echo $form->hiddenField($model,'user_id',array('class'=>'span8', 'value' => Yii::app()->user->id)); ?>
	<?php }?>

<script>
	$('#business-form').on('change', '.sub-types-select', function(){
		var $this = $(this);

		$.ajax({
			url: '/admin/businessTypes/getChildTypes',
			data: {id: $this.val()},
			success: function(data){
				if(data)
					$('.sub-types').html(data);
				else
					$('.sub-types').html('');
			}
		});
	});
</script>