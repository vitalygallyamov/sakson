<?php
/**
 * Миграция m140418_044219_update_lands
 *
 * @property string $prefix
 */
 
class m140418_044219_update_lands extends CDbMigration
{
    public function up(){
        $this->renameColumn('{{lands}}', 'square', 'square_house');
        $this->addColumn('{{lands}}', 'square_place', "decimal(8,2) COMMENT 'Площадь участка (сот.)'");
        $this->addColumn('{{lands}}', 'distance', "varchar(50) COMMENT 'Удаленность от города'");
    }

    public function down(){
        $this->renameColumn('{{lands}}', 'square_house', 'square');
        $this->dropColumn('{{lands}}', 'square_place');
        $this->dropColumn('{{lands}}', 'distance');
    }
}