<?php
/**
 * Миграция m140425_102052_update_land_states
 *
 * @property string $prefix
 */
 
class m140425_102052_update_land_states extends CDbMigration
{
    public function up(){
        $this->update('{{land_states}}', array('name' => 'Не достроен'), 'id=8');
    }

    public function down(){
        $this->update('{{land_states}}', array('name' => 'Требует ремонта'), 'id=8');
    }
}