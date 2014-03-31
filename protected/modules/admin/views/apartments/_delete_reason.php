<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'apartments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListControlGroup($model, 'delete_reason', Apartments::deleteReasons()); ?>

<?php $this->endWidget(); ?>