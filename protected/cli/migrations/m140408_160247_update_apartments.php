<?php
/**
 * Миграция m140408_160247_update_apartments
 *
 * @property string $prefix
 */
 
class m140408_160247_update_apartments extends CDbMigration
{
    public function up(){
        $this->addColumn('{{apartments}}', 'limit', 'varchar(30) COMMENT "Предел торга"');
        $this->addColumn('{{apartments}}', 'comment', 'text COMMENT "Комментарий"');
    }

    public function down(){
        $this->dropColumn('{{apartments}}', 'limit');
        $this->dropColumn('{{apartments}}', 'comment');
    }
}