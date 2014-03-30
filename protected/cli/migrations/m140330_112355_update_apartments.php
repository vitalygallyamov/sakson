<?php
/**
 * Миграция m140330_112355_update_apartments
 *
 * @property string $prefix
 */
 
class m140330_112355_update_apartments extends CDbMigration
{
    public function up(){
        $this->addColumn('{{apartments}}', 'added', 'varchar(40) COMMENT "Дополнительно"');
    }

    public function down(){
        $this->dropColumn('{{apartments}}', 'added');
    }
}