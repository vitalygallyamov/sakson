<?php
/**
 * Миграция m140318_081107_objects
 *
 * @property string $prefix
 */
 
class m140318_081107_objects extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{apartments}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{apartments}}', array(
            'id' => 'pk', // auto increment

            'apartment_type_id' => "int COMMENT 'Тип квартиры'", //
            'area_id' => "int COMMENT 'Район'", //
            'street_id' => "int COMMENT 'Улица'", //
            'house' => "varchar(20) COMMENT 'Дом'",
            'category_id' => "int COMMENT 'Категория'", //
            'floor' => "smallint COMMENT 'Этаж'",
            'house_floors' => "smallint COMMENT 'Этажность дома'",
            'square' => "decimal(8,2) COMMENT 'Площадь'",
            'kitchen_area' => "decimal(8,2) COMMENT 'Площадь кухни'",
            'walls_type_id' => "int COMMENT 'Стены'", //
            'series_id' => "int COMMENT 'Серия'", //
            'price_1m' => "decimal(10,2) COMMENT 'Стоимость 1 кв.м.'",
            'price_agency' => "decimal(10,2) COMMENT 'Стоимость услуг агенства'",
            'price' => "decimal(10,2) NOT NULL COMMENT 'Стоимость'",
            'desc' => "text COMMENT 'Описание'",
            'gllr_photos' => "int COMMENT 'Изображения'",
            'agent_id' => "int COMMENT 'Агент'", //
            'seo_id' => "int COMMENT 'SEO раздел'",
			
			'status' => "tinyint COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
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