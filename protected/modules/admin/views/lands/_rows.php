	<?php echo $form->dropDownListControlGroup($model,'way_id', CHtml::listData( LandWays::all(), 'id', 'name')); ?>
	
	<?php echo $form->dropDownListControlGroup($model,'city_id', CHtml::listData( LandCities::all(), 'id', 'name'), array('class' => 'change-city')); ?>
	
	<div class="locality">
		<? if($model->city && $model->city->localities):?>
			<?php echo $form->dropDownListControlGroup($model,'locality_id', CHtml::listData($model->city->localities, 'id', 'name')); ?>
		<? endif; ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model,'type_id', CHtml::listData( LandTypes::all(), 'id', 'name')); ?>

	<?php echo $form->dropDownListControlGroup($model,'state_id', array('' => 'Не выбрано') + CHtml::listData( LandStates::all(), 'id', 'name')); ?>

	<?php echo $form->textFieldControlGroup($model,'square',array('class'=>'span8','maxlength'=>8)); ?>
	
	<?php echo $form->dropDownListControlGroup($model,'material_id', array('' => 'Не выбрано') + CHtml::listData( LandMaterials::all(), 'id', 'name')); ?>

	<?php echo $form->dropDownListControlGroup($model,'target_id', array('' => 'Не выбрано') + CHtml::listData( LandTargets::all(), 'id', 'name')); ?>

	<?php echo $form->textFieldControlGroup($model,'price', array('class'=>'span8','maxlength'=>10)); ?>

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

	<?php echo $form->dropDownListControlGroup($model, 'status', Lands::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php 
	$model->user_id = Yii::app()->user->id;
	echo $form->hiddenField($model, 'user_id'); ?>

<script>
	$('.change-city').on('change', function(){
		var $this = $(this),
			val = $this.val();

		$.ajax({
			url: '<?=$this->createUrl("setLocalities")?>',
			data: {id: val},
			success: function(data){
				if(data){
					$('.locality').html(data);
					$('.locality').show();
				}else{
					$('.locality').hide();
				}
			}
		});
	});
</script>