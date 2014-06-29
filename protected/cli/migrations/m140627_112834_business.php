<?php
/**
 * Миграция m140627_112834_business
 *
 * @property string $prefix
 */
 
class m140627_112834_business extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{business}}', '{{business_types}}');
 
    public function safeUp()
    {
        $this->_checkTables();

        $this->createTable('{{business}}', array(
            'id' => 'pk', // auto increment

            'way_id' => "int NOT NULL COMMENT 'Направление'",
            'locality_id' => "int NOT NULL COMMENT 'Населенный пункт'",
            'street_id' => "int NOT NULL COMMENT 'Улица'",
            'house_num' => "int NOT NULL COMMENT 'Номер дома'",
            'room_num' => "int COMMENT 'Номер квартиры'",
            'square' => "decimal(8,2) COMMENT 'Площадь помещения (кв.м.)'",
            'type_id' => "int NOT NULL COMMENT 'Тип'",
            'sub_type_id' => "int COMMENT 'Под тип'",
            'state_id' => "int NOT NULL COMMENT 'Состояние'",
            'price' => "decimal(10,2) NOT NULL COMMENT 'Цена'",
            'limit' => "varchar(30) NOT NULL COMMENT 'Предел торга'",
            'phone_own' => 'string NOT NULL COMMENT  "Телефон собственника"',
            'gllr_images' => "int COMMENT 'Галерея'",
            'seo_id' => "int COMMENT 'SEO'",
            'user_id' => "int COMMENT 'Агент'",
            'desc' => "text NOT NULL COMMENT 'Описание'",
            'comment' => "text NOT NULL COMMENT 'Комментарий'",
            'delete_reason' => 'int COMMENT "Причина удаления"',
            'status' => "tinyint COMMENT 'Статус'",
            'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{business_types}}', array(
            'id' => 'pk', // auto increment
            'type' => "string COMMENT 'Тип'",
            'parent' => "int COMMENT 'Родительский тип'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //init types

        $this->insert('{{business_types}}', array( 'type' => 'Продуктовые магазины', 'parent' => 0));
        $this->insert('{{business_types}}', array( 'type' => 'Салоны ', 'parent' => 0));
        $this->insert('{{business_types}}', array( 'type' => 'Бутики ', 'parent' => 0));
        $this->insert('{{business_types}}', array( 'type' => 'Торговые павильоны ', 'parent' => 0));
        $this->insert('{{business_types}}', array( 'type' => 'Интернет магазины', 'parent' => 0));

        $last_id = Yii::app()->db->getLastInsertId();

        $this->insert('{{business_types}}' ,array('type' => 'Киоски и палатки', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Second Hand ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Детские магазины ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Зоомагазины ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Магазины косметики ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Магазины обуви ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Магазины одежды ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Магазины пива ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Магазины подарков ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Магазины спорттоваров ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Магазины цветов ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Непродовольств. магазины ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Сети магазинов ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Строительные магазины ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Хозяйственные магазины ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Ювелирные магазины ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Аптеки ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Оптика', 'parent' => $last_id));

        $this->insert('{{business_types}}', array( 'type' => 'Индустрия красоты / здоровья', 'parent' => 0));
        $last_id = Yii::app()->db->getLastInsertId();

        $this->insert('{{business_types}}' ,array('type' => 'Парикмахерские', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Бани, Сауны, Бассейны ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Свадебные салоны ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Солярии, студии загара ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Салоны красоты ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Фитнес центры ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Зоосалоны ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Косметологические и массажные кабинеты ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'СПА центры ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Спорт клубы ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Стоматологии ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Wellness центры ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Школы танца', 'parent' => $last_id));

        $this->insert('{{business_types}}', array( 'type' => 'Кафе и рестораны', 'parent' => 0));
        $last_id = Yii::app()->db->getLastInsertId();

        $this->insert('{{business_types}}' ,array('type' => 'Рестораны', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Кафе ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Бары ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Придорожный сервис ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Пивбары, пабы ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Фаст-фуд ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Бистро ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Закусочные ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Служба доставки ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Столовые ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Спорт-бар', 'parent' => $last_id));

        $this->insert('{{business_types}}', array( 'type' => 'Автобизнес / Транспорт', 'parent' => 0));
        $last_id = Yii::app()->db->getLastInsertId();

        $this->insert('{{business_types}}' ,array('type' => 'Автомойки', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'СТО ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Шиномонтажи ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'АЗС ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Автомагазины', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Автосервисы ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Автоцентры ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Автошколы ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Грузоперевозки ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Тюнинг', 'parent' => $last_id));

        $this->insert('{{business_types}}', array( 'type' => 'Развлечения, клубы, казино', 'parent' => 0));
        $last_id = Yii::app()->db->getLastInsertId();

        $this->insert('{{business_types}}' ,array('type' => 'Бильярдные клубы', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Букмекерские конторы', 'parent' => $last_id));

        $this->insert('{{business_types}}', array( 'type' => 'Производство', 'parent' => 0));
        $last_id = Yii::app()->db->getLastInsertId();
        
        $this->insert('{{business_types}}' ,array('type' => 'Пищевое производство ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Производство окон и дверей ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Производство стройматериалов ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Деревообработка ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Производство мебели ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Производство одежды ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Производство деревянных домов ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Производство металлоконструкций ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Интернет, IT ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Копи центры ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Недвижимость ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Ремонт обуви и одежды ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Ремонт телефонов и бытовой техники', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Транспортные услуги ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Учебные центры ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Финансовые услуги ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Фото услуги ', 'parent' => $last_id));
        $this->insert('{{business_types}}' ,array('type' => 'Юридические услуги', 'parent' => $last_id));

        $this->insert('{{business_types}}' ,array('type' => 'Строительные фирмы', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Отели/Гостиницы/Турбазы ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Туризм и отдых ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Арендный бизнес ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Готовые фирмы ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Заводы/промышленные помещения ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Колхозы ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Оптовая торговля ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Платежные терминалы ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Полиграфия ', 'parent' => 0));
        $this->insert('{{business_types}}' ,array('type' => 'Фермы', 'parent' => 0));
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}