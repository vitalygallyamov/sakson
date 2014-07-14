<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'admin-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('adminuser')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
        "data-id" => $data->id
    )',
	'columns'=>array(
		'fio',
		'login',
		// 'pass',
		'email',
		'phone',
		array(
			'header'=>'Права доступа',
			'type'=>'raw',
			'value'=>'$data->getRole()'
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'AdminUser::getStatusAliases($data->status)',
			'filter'=>AdminUser::getStatusAliases()
		),
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}',
			'buttons' => array(
				'delete' => array(
					'click' => 'function(){
						var $this = jQuery(this);
						jQuery.ajax({
							url: "/admin/adminUser/getAgentForm",
							data: { id: $this.closest("tr").data("id")},
							success: function(data){
								if(data.length)
									jQuery("#agentModal").find(".modal-body").html(data);
							}
						});
						jQuery("#agentModal").modal();
						return false;
					}'
				)
			)
		),
	),
)); ?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'agentModal',
    'header' => 'Внимание.',
    'content' => '',
    'footer' => array(
        TbHtml::button('Сохранить', array('class' => 'change-agent', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
        TbHtml::button('Закрыть', array('data-dismiss' => 'modal')),
     ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'thanksModal',
    'header' => 'Готово',
    'content' => 'Действие выполнено успешно!',
    'footer' => array(
        TbHtml::button('Закрыть', array('data-dismiss' => 'modal')),
     ),
)); ?>

<script>
(function($){
	$('.change-agent').on('click', function(e){
		e.preventDefault();

		var data = $('#agentModal').find('form').serialize();
		$.ajax({
			url: '/admin/adminUser/changeAgent',
			data: data,
			type: 'post',
			success: function(data){
				if(data == 'ok'){
					jQuery("#agentModal").modal('hide');
					jQuery("#thanksModal").modal('show');

					jQuery('#admin-user-grid').yiiGridView('update');
				}

			}
		});
	});
})(jQuery);
</script>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("adminuser");', CClientScript::POS_END) ;?>