<?php
/**
 * Миграция m140401_095840_update_admin_users
 *
 * @property string $prefix
 */
 
class m140401_095840_update_admin_users extends CDbMigration
{
    public function up(){

        $this->addColumn('{{admin_users}}', 'phone', 'string COMMENT "Телефон"');
    }

    public function down(){

        $this->addColumn('{{admin_users}}', 'phone');
    }
}