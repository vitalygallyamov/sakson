	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'url',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'menu_name',array('class'=>'span8','maxlength'=>255)); ?>

    <?php echo $form->dropDownListControlGroup($model, 'menu_public', Page::getMenuStatusLabel(), array('class'=>'span8', 'displaySize'=>1)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'wswg_content'); ?>
		<?php $this->widget('appext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'wswg_content',
		)); ?>
		<?php echo $form->error($model, 'wswg_content'); ?>
	</div>

    <?php echo $form->textFieldControlGroup($model,'sort'); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Page::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
