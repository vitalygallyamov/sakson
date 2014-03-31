<?php
/**
 * Миграция m140331_175419_delete_apartments
 *
 * @property string $prefix
 */
 
class m140331_175419_delete_apartments extends CDbMigration
{
    public function up(){
        $this->dropTable('{{delete_apartments}}');

        $this->addColumn('{{apartments}}', 'delete_reason', 'int COMMENT "Причина удаления"');
        $this->addColumn('{{apartments}}', 'room_num', 'tinyint COMMENT "Номер квартиры"');
    }

    public function down(){

        $this->dropColumn('{{apartments}}', 'delete_reason');
        $this->dropColumn('{{apartments}}', 'room_num');

        $this->createTable('{{delete_apartments}}', array(
            'id' => 'pk', // auto increment

            'apart_id' => "int COMMENT 'Квартира'",
            'user_id' => "int COMMENT 'Пользователь'",
            'comment' => "text COMMENT 'Комментарий'",
            
            // 'status' => "tinyint COMMENT 'Статус'",
            // 'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
}