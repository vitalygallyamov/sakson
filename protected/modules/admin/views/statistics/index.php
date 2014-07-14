<h1>Статистика</h1>
<p>Поск объектов по агентам за определенный период.</p>
<div class="form-dates row-fluid">
<?php echo TbHtml::beginFormTb(); ?>
	<div class="span3">
		<div class="input-append">
			<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
			        'name' => 'Dates[from]',
			        'value' => isset($_POST['Dates']['from']) ? $_POST['Dates']['from'] : '',
			        'pluginOptions' => array(
			            'format' => 'dd.mm.yyyy'
			        ),
			        'htmlOptions' => array(
			        	'placeholder' => 'От'
			        )
			    ));
			?>
		    <span class="add-on"><icon class="icon-calendar"></icon></span>
		</div>
	</div>
	<div class="span3">
		<div class="input-append">
			<?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
			        'name' => 'Dates[to]',
			        'value' => isset($_POST['Dates']['to']) ? $_POST['Dates']['to'] : '',
			        'pluginOptions' => array(
			            'format' => 'dd.mm.yyyy'
			        ),
			        'htmlOptions' => array(
			        	'placeholder' => 'До'

			        )
			    ));
			?>
		    <span class="add-on"><icon class="icon-calendar"></icon></span>
		</div>
	</div>
	<div class="span3">
		<?=TbHtml::submitButton('Найти');?>
	</div>

<?php echo TbHtml::endForm(); ?>	
</div>
<br>
<div class="row-fluid">
	<?php if(isset($data['result'])){ ?>
	<table class='table'>
		<tr>
			<th>Агент</th>
			<th>Количество квартир</th>
			<th>Количество земельных участков</th>
			<th>Количество объектов для бизнеса</th>
		</tr>
		<?php foreach ($data['result'] as $key => $value):?>
			<tr>
				<td><?=$value['agent']?></td>
				<td><?=$value['apartments_count']?></td>
				<td><?=$value['lands_count']?></td>
				<td><?=$value['business_count']?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php }else{ ?>
	<p>Нет результатов.</p>
	<?php }?>
</div>