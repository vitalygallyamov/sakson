<?php
/**
 * Миграция m140327_165012_dbauth
 *
 * @property string $prefix
 */
 
class m140327_165012_dbauth extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{AuthItem}}', '{{AuthItemChild}}', '{{AuthAssignment}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{AuthItem}}', array(
			'name' => "varchar(64) not null",
			'type' => "integer not null",
			'description' => "text",
            'bizrule' => "text",
            'data' => "text",
            'primary key (`name`)'
        ));

        $this->createTable('{{AuthItemChild}}', array(
            'parent' => "varchar(64) not null",
            'child' => "varchar(64) not null",
            'primary key (`parent`,`child`)'
        ));

        $this->addForeignKey('fk1_aich', '{{AuthItemChild}}', 'parent', '{{AuthItem}}', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk2_aich', '{{AuthItemChild}}', 'child', '{{AuthItem}}', 'name', 'CASCADE', 'CASCADE');

        $this->createTable('{{AuthAssignment}}', array(
            'itemname' => "varchar(64) not null",
            'userid' => "varchar(64) not null",
            'bizrule' => "text",
            'data' => "text",
            'primary key (`itemname`,`userid`)'
        ));

        $this->addForeignKey('fk_aa', '{{AuthAssignment}}', 'itemname', '{{AuthItem}}', 'name', 'CASCADE', 'CASCADE');
    }
 
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0;');
        $this->_checkTables();
        $this->execute('SET FOREIGN_KEY_CHECKS=1;');
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