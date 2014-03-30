<?php
/**
 * Миграция m140330_135837_insert_settings
 *
 * @property string $prefix
 */
 
class m140330_135837_insert_settings extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{insert_settings}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->insertMultiple("tbl_settings", array(
            array(
                "id"=>1,
                "label"=>"Адрес",
                "name"=>"address",
                "type"=>"string",
                "type_id"=>1,
            ),
            array(
                "id"=>2,
                "label"=>"Телефон",
                "name"=>"phone",
                "type"=>"string",
                "type_id"=>2,
            ),
            array(
                "id"=>3,
                "label"=>"Ссылка на Facebook",
                "name"=>"fb_link",
                "type"=>"string",
                "type_id"=>3,
            ),
            array(
                "id"=>4,
                "label"=>"Ссылка на Twitter",
                "name"=>"tw_link",
                "type"=>"string",
                "type_id"=>4,
            ),
            array(
                "id"=>5,
                "label"=>"Ссылка на Вконтакте",
                "name"=>"vk_link",
                "type"=>"string",
                "type_id"=>5,
            ),
            array(
                "id"=>6,
                "label"=>"Ссылка на Skype",
                "name"=>"sk_link",
                "type"=>"string",
                "type_id"=>6,
            ),
        ));

        $this->insertMultiple("tbl_settings_string", array(
            array(
                "id"=>1,
                "value"=>"Тюмень, Республики, 83а<br>Офис 204.",
            ),
            array(
                "id"=>2,
                "value"=>"+7 919 953 13 05<br>+7 919 953 17 01",
            ),
            array(
                "id"=>3,
                "value"=>"#",
            ),
            array(
                "id"=>4,
                "value"=>"#",
            ),
            array(
                "id"=>5,
                "value"=>"#",
            ),
            array(
                "id"=>6,
                "value"=>"#",
            ),
        ));
    }
 
    public function safeDown()
    {
        $this->truncateTable("tbl_settings");
        $this->truncateTable("tbl_settings_string");
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