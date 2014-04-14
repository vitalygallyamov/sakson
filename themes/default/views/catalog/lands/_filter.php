<h3><img src="<?=$this->getAssetsUrl()?>/images/li_h3.png" style="margin:0 5px -2px 0;"> Поиск</h3>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'apartments-form',
    'method' => 'GET',
    'htmlOptions' => array(
        'class' => 'catalog_filter'
    )
)); ?>
<?php echo CHtml::beginForm('', 'GET', array('class' => 'catalog_filter')); ?>
    
    <div class="row">
        <div class="cell">
            <?php echo $form->label($model, 'way_id'); ?>
            <?php echo $form->dropDownList($model, 'way_id', $this->getDropDownList('LandWays', true)); ?>
        </div>
        <div class="cell">
            <?php echo $form->label($model, 'city_id'); ?>
            <?php echo $form->dropDownList($model, 'city_id', $this->getDropDownList('LandCities', true)); ?>
        </div>
        <div class="clear"></div>
    </div>

    <?php echo CHtml::label('Цена', 'price_from'); ?>
    <?php echo CHtml::textField('price_from', isset($_GET['price_from']) ? $_GET['price_from'] : '', array('placeholder' => 'От')); ?>
    /
    <?php echo CHtml::textField('price_to', isset($_GET['price_to']) ? $_GET['price_to'] : '', array('placeholder' => 'До')); ?>

    <?php echo CHtml::label('Площадь (м2)', 'square_from'); ?>
    <?php echo CHtml::textField('square_from', isset($_GET['square_from']) ? $_GET['square_from'] : '', array('placeholder' => 'От')); ?>
    /
    <?php echo CHtml::textField('square_to', isset($_GET['square_to']) ? $_GET['square_to'] : '', array('placeholder' => 'До')); ?>

    <?php echo $form->label($model, 'type_id'); ?>
    <?php echo $form->dropDownList($model, 'type_id', $this->getDropDownList('LandTypes', true)); ?>

    <?php echo $form->label($model, 'state_id'); ?>
    <?php echo $form->dropDownList($model, 'state_id', $this->getDropDownList('LandStates', true)); ?>

    <?php echo $form->label($model, 'material_id'); ?>
    <?php echo $form->dropDownList($model, 'material_id', $this->getDropDownList('LandMaterials', true)); ?>

    <?php echo $form->label($model, 'target_id'); ?>
    <?php echo $form->dropDownList($model, 'target_id', $this->getDropDownList('LandTargets', true)); ?>
    
    <?php /*echo CHtml::label('Цена', 'price_from'); ?>
    <?php echo CHtml::textField('price_from', isset($_GET['price_from']) ? $_GET['price_from'] : '', array('placeholder' => 'От')); ?>
    /
    <?php echo CHtml::textField('price_to', isset($_GET['price_to']) ? $_GET['price_to'] : '', array('placeholder' => 'До')); ?>

    <?php echo CHtml::label('Площадь (м2)', 'square_from'); ?>
    <?php echo CHtml::textField('square_from', isset($_GET['square_from']) ? $_GET['square_from'] : '', array('placeholder' => 'От')); ?>
    /
    <?php echo CHtml::textField('square_to', isset($_GET['square_to']) ? $_GET['square_to'] : '', array('placeholder' => 'До')); ?>
    
    <?php echo CHtml::label('Количество комнат', 'rooms'); ?>
    <?php echo $form->checkBoxList($model, 'apartment_type_id', array(1 => '1', 2 => '2', 3 => '3', 4 => '4+'), array('container' => '', 'separator' => '')); ?>
    <?php //echo CHtml::checkBoxList('rooms', '', , array('container' => '', 'separator' => '')); ?>
    <div class="clear"></div>
    
    <?php echo CHtml::label('Этаж', 'floor_from'); ?>
    <?php echo CHtml::textField('floor_from', isset($_GET['floor_from']) ? $_GET['floor_from'] : '', array('placeholder' => 'От')); ?>
    /
    <?php echo CHtml::textField('floor_to', isset($_GET['floor_to']) ? $_GET['floor_to'] : '', array('placeholder' => 'До')); ?>

    <?php echo $form->label($model, 'series_id'); ?>
    <?php echo $form->dropDownList($model, 'series_id', $this->getDropDownList('Series', true)); ?>
    
    <?php echo $form->label($model, 'added'); ?>
    <?php echo $form->checkBoxList($model, 'added', Apartments::addedList(), array('container' => '', 'separator' => '')); */?>
    <div class="clear"></div>
    
    <div class="actions">
        <?php echo CHtml::submitButton('Найти'); ?>
        <?php echo CHtml::link('Сбросить', '/catalog'); ?>
    </div>
<?php $this->endWidget(); ?>