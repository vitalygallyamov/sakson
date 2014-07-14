<p>Перед тем как удалять агента, нужно перенести все объекты на другого агента.</p>

<p>Кол-во объектов агента:</p>
<ul>
	<li>Квартиры: <strong><?=$data['apartments']?></strong></li>
	<li>Земельные участки: <strong><?=$data['lands']?></strong></li>
	<li>Объекты для бизнеса: <strong><?=$data['business']?></strong></li>
</ul>

<p>Выберите агента, к которому будут прекреплены все объекты</p>
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::dropDownList('new_agent_id', false, AdminUser::getAgents($data['id'])); ?>
<?php echo CHtml::hiddenField('old_agent_id', $data['id']); ?>

<?php echo CHtml::endForm();?>