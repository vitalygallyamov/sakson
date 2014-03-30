	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_logo'); ?>
		<?php echo $form->fileField($model,'img_logo', array('class'=>'span3')); ?>
		<div class='img_preview'>
			<?php if ( !empty($model->img_logo) ) echo TbHtml::imageRounded( $model->imgBehaviorLogo->getImageUrl('normal') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Partner' data-attributename='Logo' <?php if(empty($model->img_logo)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_logo'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaControlGroup($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Partner::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
