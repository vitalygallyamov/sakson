<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title><?php echo CHtml::encode(Yii::app()->name).' | Admin';?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	  
		<?php
			$menuItems = array(
                array('label'=>'Главная', 'url'=>'/admin/start/index'),
				// array('label'=>'Настройки', 'url'=>'/admin/settings'),
				array('label'=>'Объекты', 'url'=>'#', 'items' => array(
					array('label'=>'Квартиры', 'url'=>'#', 'items' => array(
						array('label'=>'Создать', 'url'=>"/admin/apartments/create"),
						array('label'=>'Список', 'url'=>"/admin/apartments/list"),
					)),
				)),
				array('label'=>'Пользователи', 'url'=>'/admin/adminUser/', 'visible' => Yii::app()->user->checkAccess('admin')),
			);
		?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			'color'=>'inverse', // null or 'inverse'
			'brandLabel'=> CHtml::encode(Yii::app()->name),
			'brandUrl'=>'/',
			'fluid' => true,
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'items'=>$menuItems,
				),
				array(
					'class'=>'bootstrap.widgets.TbNav',
					'htmlOptions'=>array('class'=>'pull-right'),
					'items'=>array(
						array('label' => 'Пользователь ('.Yii::app()->user->name.')', 'url' => Yii::app()->createUrl('admin/adminUser/update', array('id' => Yii::app()->user->id))),
						array('label'=>'Выйти', 'url'=>'/admin/user/logout'),
					),
				),
			),
		)); ?>

		<div class="container-fluid">
			<div class="row-fluid">
				<?php echo $content; ?>
			</div>
		</div>

	</body>
</html>
