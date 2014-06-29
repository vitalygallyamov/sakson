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
            <?php echo $form->label($model, 'locality_id'); ?>
            <?php echo $form->dropDownList($model, 'locality_id', $this->getDropDownList('LandLocalities', true)); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="row">
        <div class="cell">
            <?php echo $form->label($model, 'street_id'); ?>
            <?php echo $form->dropDownList($model, 'street_id', $this->getDropDownList('Streets', true)); ?>
        </div>
        <div class="cell">
            <?php echo $form->label($model, 'state_id'); ?>
            <?php echo $form->dropDownList($model, 'state_id', $this->getDropDownList('LandStates', true)); ?>
        </div>
        <div class="clear"></div>
    </div>

    <label for="price_from">Цена (<span>руб.</span>)</label>
    <?php echo CHtml::textField('price_from', isset($_GET['price_from']) ? $_GET['price_from'] : '', array('placeholder' => 'От')); ?>
    /
    <?php echo CHtml::textField('price_to', isset($_GET['price_to']) ? $_GET['price_to'] : '', array('placeholder' => 'До')); ?>

    <label for="Lands_square_house">Площадь (<span>м<sup>2</sup></span>)</label>
    <?php echo CHtml::textField('square_from', isset($_GET['square_from']) ? $_GET['square_from'] : '', array('placeholder' => 'От')); ?>
    /
    <?php echo CHtml::textField('square_to', isset($_GET['square_to']) ? $_GET['square_to'] : '', array('placeholder' => 'До')); ?>
    
    <div class="row">
        <div class="cell bus-cell bus-type">
            <?php echo $form->label($model, 'type_id'); ?>
            <?php echo $form->dropDownList($model, 'type_id', CHtml::listData(BusinessTypes::getRootTypes(), 'id', 'type')); ?>
        </div>
        <div class="cell bus-cell sub-type"></div>
        
    </div>
    <div class="clear"></div>
    
    <div class="actions">
        <?php echo CHtml::submitButton('Найти'); ?>
        <?php echo CHtml::link('Сбросить', '/catalog/lands'); ?>
    </div>
<?php $this->endWidget(); ?>

<script>
    $('.catalog').on('change', '.bus-type select', function(){
        var $this = $(this);

        $.ajax({
            url: '/catalog/GetBusinessTypes',
            data: {id: $this.val()},
            success: function(data){
                 $this.closest('form').find('.sub-type').html(data);
            }
        });
    });
</script>