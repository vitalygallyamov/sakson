<div class="catalog">
    <div class="left_col">
        <h3><img src="images/li_h3.png" style="margin:0 5px -2px 0;"> Поиск</h3>
        <form class="catalog_filter">
            <label for="example_select">Район</label>
            <select id="example_select">
                <option value=""></option>
                <option value="1">Калининский</option>
                <option value="1">Ленинский</option>
                <option value="1">Центральный</option>
            </select>

            <label for="example_input_inline">Цена (тыс. руб.)</label>
            <input type="text" placeholder="От" id="example_input_inline">
            /
            <input type="text" placeholder="До">

            <label for="example_input_inline2">Площадь (м2)</label>
            <input type="text" placeholder="От" id="example_input_inline2">
            /
            <input type="text" placeholder="До">

            
            
            <label>Количество комнат</label>
            <input id="cfirst1" type="checkbox" name="first" checked hidden />
            <label for="cfirst1">1</label>

            <input id="cfirst2" type="checkbox" name="first" checked hidden />
            <label for="cfirst2">2</label>

            <input id="cfirst3" type="checkbox" name="first" checked hidden />
            <label for="cfirst3">3</label>

            <input id="cfirst4" type="checkbox" name="first" checked hidden />
            <label for="cfirst4">4</label>
            <div class="clear"></div>


            <label for="example_input_inline3">Этаж</label>
            <input type="text" placeholder="От" id="example_input_inline3">
            /
            <input type="text" placeholder="До">

            <label for="example_select2">Серия</label>
            <select id="example_select2">
                <option value=""></option>
                <option value="1">Т2</option>
                <option value="1">Т4</option>
                <option value="1">Т6</option>
            </select>

            <label>Дополнительно</label>
            <input id="cfirst11" type="checkbox" name="first" checked hidden />
            <label for="cfirst11">Срочно</label>

            <input id="cfirst12" type="checkbox" name="first" checked hidden />
            <label for="cfirst12">Ипотека</label>
            <div class="clear"></div>

            <input type="submit" value='Найти'>
        </form>
        
    </div>

    <div class="center_col">
        <div class="items">
            <? $this->renderPartial('apartments/_listview', array('dataProvider' => $dataProvider)); ?>
        </div>
    </div>
</div>