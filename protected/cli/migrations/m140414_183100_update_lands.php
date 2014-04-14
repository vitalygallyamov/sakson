<?php
/**
 * Миграция m140414_183100_update_lands
 *
 * @property string $prefix
 */
 
class m140414_183100_update_lands extends CDbMigration
{
    public function up(){
        $this->addColumn('{{lands}}', 'delete_reason', 'int COMMENT "Причина удаления"');
        $this->addColumn('{{lands}}', 'comment', 'text COMMENT "Комментарий"');
        $this->addColumn('{{lands}}', 'desc', 'text COMMENT "Описание"');
        $this->addColumn('{{lands}}', 'phone_own', 'string COMMENT "Телефон собственника"');
    }

    public function down(){
        $this->dropColumn('{{lands}}', 'delete_reason');
        $this->dropColumn('{{lands}}', 'comment');
        $this->dropColumn('{{lands}}', 'desc');
        $this->dropColumn('{{lands}}', 'phone_own');
    }
}