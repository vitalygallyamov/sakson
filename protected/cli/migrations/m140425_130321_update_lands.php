<?php
/**
 * Миграция m140425_130321_update_lands
 *
 * @property string $prefix
 */
 
class m140425_130321_update_lands extends CDbMigration
{
    public function up(){
        $this->alterColumn('{{lands}}', 'distance', 'int COMMENT "Удаленность от города"');
    }
    public function down(){
        $this->alterColumn('{{lands}}', 'distance', 'varchar(50) COMMENT "Удаленность от города"');
    }
}