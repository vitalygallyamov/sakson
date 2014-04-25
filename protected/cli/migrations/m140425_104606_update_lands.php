<?php
/**
 * Миграция m140425_104606_update_lands
 *
 * @property string $prefix
 */
 
class m140425_104606_update_lands extends CDbMigration
{
    public function up(){
        $this->addColumn('{{lands}}', 'street_id', 'int COMMENT "Улица"');
        $this->addColumn('{{lands}}', 'house_num', 'varchar(20) COMMENT "№ дома"');
    }

    public function down(){
        $this->dropColumn('{{lands}}', 'street_id');
        $this->dropColumn('{{lands}}', 'house_num');
    }
}