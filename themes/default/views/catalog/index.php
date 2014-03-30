<?php
/* @var $this LandsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lands',
);

$this->menu=array(
	array('label'=>'Create Lands', 'url'=>array('create')),
	array('label'=>'Manage Lands', 'url'=>array('admin')),
);
?>

<h1>Lands</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
