<div class="catalog">
    <div class="left_col">
        <? $this->renderPartial('apartments/_filter', array('model' => $model)); ?>        
    </div>

    <div class="center_col">
        <div class="items">
            <? $this->renderPartial('apartments/_listview', array('dataProvider' => $dataProvider)); ?>
        </div>
    </div>
</div>