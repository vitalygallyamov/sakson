<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'apartments-form',
	'enableAjaxValidation'=>false,
	'method' => 'get',
)); ?>
	<h4>Фильтр</h4>
	<div class="row-fluid">
		<?/*<div class="span2"><?php echo $form->label($model,'apartment_type_id'); ?><?php echo $form->dropDownList($model,'apartment_type_id', CHtml::listData(ApartmentTypes::all(), 'id', 'name')); ?></div>*/?>
		<div class="span1">
			<label for="">Цена от: </label>
			<?php echo CHtml::textField('priceBegin', isset($_GET['priceBegin']) ? $_GET['priceBegin'] : 0, array('append' => 'руб.', 'class' => 'span11')); ?>
		</div>
		<div class="span1">
			<label for="">Цена до: </label>
			<?php echo CHtml::textField('priceEnd', isset($_GET['priceEnd']) ? $_GET['priceEnd'] : 0, array('append' => 'руб.', 'class' => 'span11')); ?>
		</div>
		<div class="span2">
			<?php echo $form->label($model,'area_id');?>
			<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'area_id',
				'data' => CHtml::listData(Areas::all(), 'id', 'name'),
				'pluginOptions' => array(
			    	'width' => '100%',
				)
			));?>
		</div>
		<div class="span2">
			<?php echo $form->label($model,'category_id');?>
			<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'category_id',
				'data' => CHtml::listData(Categories::all(), 'id', 'name'),
				'pluginOptions' => array(
				    'width' => '100%',
					)
			));?>
		</div>
		<div class="span2">
			<?php echo $form->label($model,'series_id');?>
			<?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
				'model' => $model,
				'attribute' => 'series_id',
				'data' => CHtml::listData(Series::all(), 'id', 'name'),
				'pluginOptions' => array(
				    'width' => '100%',
					)
				));?>
		</div>
		<?/*<div class="span2"><?php echo $form->label($model,'square'); ?><?php echo $form->textField($model, 'square', array('append' => 'кв.м.', 'maxlength'=>8, 'class' => 'square')); ?></div>*/?>
	</div>
	
	<?php echo TbHtml::submitButton('Найти', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>