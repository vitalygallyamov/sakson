	<?php echo $form->textFieldControlGroup($model,'fio',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'login',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->passwordFieldControlGroup($model,'pass',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'phone',array('class'=>'span8','maxlength'=>255)); ?>
	
	<?php echo TbHtml::dropDownListControlGroup('role', 0, AdminUser::getRoles(), array('label' => 'Права')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', AdminUser::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
