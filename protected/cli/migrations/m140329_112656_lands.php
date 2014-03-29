<?php
/**
 * Миграция m140329_112656_lands
 *
 * @property string $prefix
 */
 
class m140329_112656_lands extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{lands}}','{{land_ways}}','{{land_cities}}','{{land_localities}}','{{land_types}}','{{land_states}}','{{land_materials}}','{{land_targets}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{lands}}', array(
            'id' => 'pk', // auto increment

            'way_id' => "int COMMENT 'Направление'",
            'city_id' => "int COMMENT 'Город, район'",
            'locality_id' => "int COMMENT 'Населенный пункт'",
            'type_id' => "int COMMENT 'Тип'",
			'state_id' => "int COMMENT 'Состояние'",
            'square' => "decimal(8,2) COMMENT 'Площадь (кв.м.)'",
            'material_id' => "int COMMENT 'Материал'",
            'target_id' => "int COMMENT 'Назначение земли'",
            'price' => "decimal(10,2) COMMENT 'Цена'",
            'gllr_images' => "int COMMENT 'Галерея'",
            'seo_id' => "int COMMENT 'SEO'",
            'user_id' => "int COMMENT 'Пользователь'",
			
			'status' => "tinyint COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //Справочники
        //-------------------------------------------
        $this->createTable('{{land_ways}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{land_ways}}', array(
            array('name' => 'Тюмень (в черте города)'),
            array('name' => 'Велижанский тракт'),
            array('name' => 'Ирбитский тракт'),
            array('name' => 'Московский тракт'),
            array('name' => 'На Горьковку'),
            array('name' => 'Салаирский тракт'),
            array('name' => 'Старый Тобольский'),
            array('name' => 'Тобольский тракт'),
            array('name' => 'Червишевский тракт'),
            array('name' => 'Ялуторовский тракт')
        ));

        //-------------------------------------------
        $this->createTable('{{land_cities}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{land_cities}}', array(
            array('name' => 'Тюмень '),
            array('name' => 'Тобольск'),
            array('name' => 'Ишим'),
            array('name' => 'Ялуторовск'),
            array('name' => 'Заводоуковск'),
            array('name' => 'Голошманово'),
            array('name' => 'Исетское (Тюменской области)'),
            array('name' => 'Омутинское'),
            array('name' => 'Нижняя Тавда'),
            array('name' => 'Ярково (Тюменской области)'),
            array('name' => 'Тюменский район'), //11
            array('name' => 'Нижнетавдинский район'), //12
            array('name' => 'Исетский район') //13
        ));

        //-------------------------------------------
        $this->createTable('{{land_localities}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'",
            'city_id' => "int COMMENT 'Район'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{land_localities}}', array(
            array('name' => 'Аманадское', 'city_id' => 11),
            array('name' => 'Андреевский', 'city_id' => 11),
            array('name' => 'Богандинский', 'city_id' => 11),
            array('name' => 'Богандинское', 'city_id' => 11),
            array('name' => 'Большие Акияры', 'city_id' => 11),
            array('name' => 'Борки', 'city_id' => 11),
            array('name' => 'Боровский', 'city_id' => 11),
            array('name' => 'Вилижаны', 'city_id' => 11),
            array('name' => 'Винзили', 'city_id' => 11),
            array('name' => 'Головина', 'city_id' => 11),
            array('name' => 'Горьковка', 'city_id' => 11),
            array('name' => 'Гужевое', 'city_id' => 11),
            array('name' => 'Гусево', 'city_id' => 11),
            array('name' => 'Дербыши', 'city_id' => 11),
            array('name' => 'Друганова', 'city_id' => 11),
            array('name' => 'Дударева', 'city_id' => 11),
            array('name' => 'Елань', 'city_id' => 11),
            array('name' => 'Ембаево', 'city_id' => 11),
            array('name' => 'Есаулова', 'city_id' => 11),
            array('name' => 'Железный Перебор', 'city_id' => 11),
            array('name' => 'Зубарева', 'city_id' => 11),
            array('name' => 'Зырянка', 'city_id' => 11),
            array('name' => 'Каменка', 'city_id' => 11),
            array('name' => 'Каскара', 'city_id' => 11),
            array('name' => 'Княжево', 'city_id' => 11),
            array('name' => 'Коняшина', 'city_id' => 11),
            array('name' => 'Костылева', 'city_id' => 11),
            array('name' => 'Криводанова', 'city_id' => 11),
            array('name' => 'Кулаково', 'city_id' => 11),
            array('name' => 'Кулига', 'city_id' => 11),
            array('name' => 'Кыштырла', 'city_id' => 11),
            array('name' => 'Леваши', 'city_id' => 11),
            array('name' => 'Луговое', 'city_id' => 11),
            array('name' => 'Малиновка', 'city_id' => 11),
            array('name' => 'Малые Акияры', 'city_id' => 11),
            array('name' => 'Мальково', 'city_id' => 11),
            array('name' => 'Марай', 'city_id' => 11),
            array('name' => 'Мичурино', 'city_id' => 11),
            array('name' => 'Молчанова', 'city_id' => 11),
            array('name' => 'Московский', 'city_id' => 11),
            array('name' => 'Муллаши', 'city_id' => 11),
            array('name' => 'Нариманова', 'city_id' => 11),
            array('name' => 'Насекина', 'city_id' => 11),
            array('name' => 'Новотарманский', 'city_id' => 11),
            array('name' => 'Новотуринский', 'city_id' => 11),
            array('name' => 'Ожогина', 'city_id' => 11),
            array('name' => 'Онохино', 'city_id' => 11),
            array('name' => 'Ошкукова', 'city_id' => 11),
            array('name' => 'Падерина', 'city_id' => 11),
            array('name' => 'Паренкина', 'city_id' => 11),
            array('name' => 'Патрушева', 'city_id' => 11),
            array('name' => 'Перевалово', 'city_id' => 11),
            array('name' => 'Песьянка', 'city_id' => 11),
            array('name' => 'Подъем', 'city_id' => 11),
            array('name' => 'Посохова', 'city_id' => 11),
            array('name' => 'Пышма', 'city_id' => 11),
            array('name' => 'Пышминка', 'city_id' => 11),
            array('name' => 'Речкина', 'city_id' => 11),
            array('name' => 'Решетникова', 'city_id' => 11),
            array('name' => 'Салаирка', 'city_id' => 11),
            array('name' => 'Созоново', 'city_id' => 11),
            array('name' => 'Субботина', 'city_id' => 11),
            array('name' => 'Тураева', 'city_id' => 11),
            array('name' => 'Туринский', 'city_id' => 11),
            array('name' => 'Успенка', 'city_id' => 11),
            array('name' => 'Утешевский', 'city_id' => 11),
            array('name' => 'Ушакова', 'city_id' => 11),
            array('name' => 'Чаплык', 'city_id' => 11),
            array('name' => 'Червишево', 'city_id' => 11),
            array('name' => 'Черная Речка', 'city_id' => 11),
            array('name' => 'Чикча', 'city_id' => 11),
            array('name' => 'Щербак', 'city_id' => 11),
            array('name' => 'Якуши', 'city_id' => 11),
            array('name' => 'Янтык', 'city_id' => 11),
            array('name' => 'Яр', 'city_id' => 11),
            array('name' => 'Андрюшинское', 'city_id' => 12),
            array('name' => 'Антипинское', 'city_id' => 12),
            array('name' => 'Березовское', 'city_id' => 12),
            array('name' => 'Бухтальское', 'city_id' => 12),
            array('name' => 'Велижанское', 'city_id' => 12),
            array('name' => 'Искинское', 'city_id' => 12),
            array('name' => 'Канашское', 'city_id' => 12),
            array('name' => 'Ключевское', 'city_id' => 12),
            array('name' => 'Миясское', 'city_id' => 12),
            array('name' => 'Нижнетавдинское', 'city_id' => 12),
            array('name' => 'Новоникольское', 'city_id' => 12),
            array('name' => 'Новотроицкое', 'city_id' => 12),
            array('name' => 'Тавдинское', 'city_id' => 12),
            array('name' => 'Тарманское', 'city_id' => 12),
            array('name' => 'Тюневское', 'city_id' => 12),
            array('name' => 'Чугунаевское', 'city_id' => 12),
            array('name' => 'Архангельское', 'city_id' => 13),
            array('name' => 'Бархатовское', 'city_id' => 13),
            array('name' => 'Бобылевское', 'city_id' => 13),
            array('name' => 'Верхнебешкильское', 'city_id' => 13),
            array('name' => 'Верхнеингальское', 'city_id' => 13),
            array('name' => 'Денисовское', 'city_id' => 13),
            array('name' => 'Исетское', 'city_id' => 13),
            array('name' => 'Кировское', 'city_id' => 13),
            array('name' => 'Коммунаровское', 'city_id' => 13),
            array('name' => 'Красновское', 'city_id' => 13),
            array('name' => 'Мининское', 'city_id' => 13),
            array('name' => 'Рассветовское', 'city_id' => 13),
            array('name' => 'Рафайловское', 'city_id' => 13),
            array('name' => 'Слободобешкильское', 'city_id' => 13),
            array('name' => 'Солобоевское', 'city_id' => 13),
            array('name' => 'Шороховское', 'city_id' => 13)
        ));

        //-------------------------------------------
        $this->createTable('{{land_types}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{land_types}}', array(
            array('name' => 'Дом'),
            array('name' => 'Участок'),
            array('name' => 'Дача'),
        ));

        //-------------------------------------------
        $this->createTable('{{land_states}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{land_states}}', array(
            array('name' => 'Обычное состояние'),
            array('name' => 'Евроремонт'),
            array('name' => 'Дизайн-проект'),
            array('name' => 'От строителей'),
            array('name' => 'Требует ремонта'),
            array('name' => 'Хороший ремонт'),
            array('name' => 'Черновая отделка'),
            array('name' => 'Требует ремонта'),
            array('name' => 'Улучшенная черновая'),
            array('name' => 'Чистовая отделка'),
        ));

        //-------------------------------------------
        $this->createTable('{{land_materials}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{land_materials}}', array(
            array('name' => 'Кирпич'),
            array('name' => 'Монолитно-каркасный'),
            array('name' => 'Панельный'),
            array('name' => 'Монолитный'),
            array('name' => 'Насыпной'),
            array('name' => 'Щитовой'),
            array('name' => 'Деревянный'),
            array('name' => 'Блоки'),
            array('name' => 'Блоки+кирпич'),
            array('name' => 'Дерево+кирпич'),
            array('name' => 'Пенозаливной'),
            array('name' => 'Каркасный')
        ));

        //-------------------------------------------
        $this->createTable('{{land_targets}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{land_targets}}', array(
            array('name' => 'ИЖС'),
            array('name' => 'ЛПХ'),
            array('name' => 'ЖЗ+Соц.культ.быт'),
            array('name' => 'КФХ'),
            array('name' => 'Многоэтажное строительство'),
            array('name' => 'Общественно деловое'),
            array('name' => 'Промышленное'),
            array('name' => 'Сад и огород'),
            array('name' => 'Сельхоз')
        ));
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}