<?php
/**
 * Миграция m140401_095514_update_apartments
 *
 * @property string $prefix
 */
 
class m140401_095514_update_apartments extends CDbMigration
{
    public function up(){
        $this->alterColumn('{{apartments}}', 'room_num', 'smallint COMMENT "Номер квартиры"');
    }

    public function down(){
        $this->alterColumn('{{apartments}}', 'room_num', 'tinyint COMMENT "Номер квартиры"');
    }
}