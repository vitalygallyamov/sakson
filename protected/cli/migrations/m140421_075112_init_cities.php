<?php
/**
 * Миграция m140421_075112_init_cities
 *
 * @property string $prefix
 */
 
class m140421_075112_init_cities extends CDbMigration
{
    public function up(){
        $this->dropTable('{{land_cities}}');

        $this->addColumn('{{streets}}', 'city_id', "string COMMENT 'Город'");
        $this->insert('{{cities}}', array('name' => 'Тюмень'));
        $this->update('{{streets}}', array('city_id' => 1));
    }

    public function down(){
        $this->dropColumn('{{streets}}', 'city_id');
        $this->truncateTable('{{cities}}');

        $this->createTable('{{land_cities}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Значение'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
}