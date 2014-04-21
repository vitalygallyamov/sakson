<?php
/**
 * Миграция m140421_045323_update_lands
 *
 * @property string $prefix
 */
 
class m140421_045323_update_lands extends CDbMigration
{
    public function up(){
        $this->addColumn('{{lands}}', 'added', "string COMMENT 'Дополнительные характеристики'");
    }

    public function down(){
        $this->dropColumn('{{lands}}', 'added');
    }
}