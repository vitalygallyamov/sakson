<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_name')); ?>:</b>
	<?php echo CHtml::encode($data->menu_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_public')); ?>:</b>
	<?php echo CHtml::encode($data->menu_public); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wswg_content')); ?>:</b>
	<?php echo CHtml::encode($data->wswg_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_id')); ?>:</b>
	<?php echo CHtml::encode($data->seo_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

</div>