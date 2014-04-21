<?php
	if(is_string($model->added)){
		$model->added = explode(',', $model->added);
	}
?>
	<?php echo $form->dropDownListControlGroup($model,'way_id', CHtml::listData( LandWays::all(), 'id', 'name')); ?>
	
	<?php echo $form->dropDownListControlGroup($model,'locality_id', CHtml::listData( LandLocalities::all(array('order' => 'name')), 'id', 'name')); ?>

	<?php echo $form->dropDownListControlGroup($model,'type_id', CHtml::listData( LandTypes::all(), 'id', 'name')); ?>

	<?php echo $form->dropDownListControlGroup($model,'state_id', array('' => 'Не выбрано') + CHtml::listData( LandStates::all(), 'id', 'name')); ?>

	<?php echo $form->textFieldControlGroup($model,'square_house',array('class'=>'span8','maxlength'=>8)); ?>

	<?php echo $form->textFieldControlGroup($model,'square_place',array('class'=>'span8','maxlength'=>8)); ?>
	
	<?php echo $form->dropDownListControlGroup($model,'material_id', array('' => 'Не выбрано') + CHtml::listData( LandMaterials::all(), 'id', 'name')); ?>

	<?php echo $form->dropDownListControlGroup($model,'target_id', array('' => 'Не выбрано') + CHtml::listData( LandTargets::all(), 'id', 'name')); ?>

	<?php echo $form->textFieldControlGroup($model,'price', array('class'=>'span8','maxlength'=>10)); ?>

	<?php echo $form->textFieldControlGroup($model,'distance', array('class'=>'span8','maxlength'=>50)); ?>

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

    <?php echo $form->textFieldControlGroup($model,'phone_own'); ?>

    <?php echo $form->textAreaControlGroup($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->checkBoxListControlGroup($model, 'added', Lands::addedOptions()); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Lands::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<?php 
	$model->user_id = Yii::app()->user->id;
	echo $form->hiddenField($model, 'user_id'); ?>