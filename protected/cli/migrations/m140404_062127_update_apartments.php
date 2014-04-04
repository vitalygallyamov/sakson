<?php
/**
 * Миграция m140404_062127_update_apartments
 *
 * @property string $prefix
 */
 
class m140404_062127_update_apartments extends CDbMigration
{
    public function up(){
        $this->dropColumn('{{apartments}}', 'price_agency');
        $this->addColumn('{{apartments}}', 'phone_own', 'string COMMENT "Телефон собственника"');
        $this->addColumn('{{apartments}}', 'life_time_house', 'string COMMENT "Срок эксплуатации дома"');
    }

    public function down(){
        $this->addColumn('{{apartments}}','price_agency', "decimal(10,2) COMMENT 'Стоимость услуг агенства'");
        $this->dropColumn('{{apartments}}', 'phone_own');
        $this->dropColumn('{{apartments}}', 'life_time_house');
    }
}