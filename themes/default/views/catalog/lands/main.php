<div class="catalog">
    <div class="left_col">
        <? $this->renderPartial('lands/_filter', array('model' => $model)); ?>        
    </div>

    <div class="center_col">
        <div class="items">
            <? $this->renderPartial('lands/_listview', array('dataProvider' => $dataProvider)); ?>
        </div>
    </div>
</div>