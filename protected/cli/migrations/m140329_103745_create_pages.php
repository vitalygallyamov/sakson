<?php
/**
 * Миграция m140329_103745_create_pages
 *
 * @property string $prefix
 */
 
class m140329_103745_create_pages extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('tbl_pages');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('tbl_pages', array(
            'id' => 'pk', // auto increment
			'menu_name' => "VARCHAR(255) COMMENT 'Название в меню'",
			'menu_public' => "TINYINT NOT NULL DEFAULT '0' COMMENT 'Показывать в меню'",
			'wswg_content' => "TEXT COMMENT 'Контент'",
			'seo_id' => "INTEGER COMMENT 'SEO данные'",
			'status' => "tinyint NOT NULL DEFAULT '0' COMMENT 'Статус'",
			'sort' => "integer NOT NULL DEFAULT '0' COMMENT 'Вес для сортировки'",
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