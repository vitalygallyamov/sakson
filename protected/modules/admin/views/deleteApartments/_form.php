<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'delete-apartments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('/deleteApartments/_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>
	
	<? if(!Yii::app()->request->isAjaxRequest):?>
	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/deleteapartments/list')); ?>
	</div>
	<? endif; ?>

<?php $this->endWidget(); ?>
