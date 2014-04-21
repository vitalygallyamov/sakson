	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model,'city_id', CHtml::listData(Cities::all(), 'id', 'name')); ?>