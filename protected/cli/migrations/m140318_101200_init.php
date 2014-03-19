<?php
/**
 * Миграция m140318_101200_init
 *
 * @property string $prefix
 */
 
class m140318_101200_init extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{apartment_types}}','{{areas}}', '{{streets}}', '{{categories}}', '{{wall_types}}', '{{series}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        //apartment_types
        $this->createTable('{{apartment_types}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Тип'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{apartment_types}}', array(
            array('name' => '1 комнатная квартира'),
            array('name' => '2 комнатная квартира'),
            array('name' => '3 комнатная квартира'),
            array('name' => '4+ комнатная квартира'),
            array('name' => 'Комната'),
            array('name' => 'Многокомнатная'),
            array('name' => 'Пансионат'),
            array('name' => 'Пентхаус'),
            array('name' => 'Студия')
        ));

        //areas
        $this->createTable('{{areas}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Район'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{areas}}', array(
            array('name' => '1 микрорайон'),
            array('name' => '2 микрорайон'),
            array('name' => '3 микрорайон'),
            array('name' => '4 микрорайон'),
            array('name' => '5 микрорайон'),
            array('name' => '6 микрорайон'),
            array('name' => 'Антипино'),
            array('name' => 'Ашан'),
            array('name' => 'Бабарынка'),
            array('name' => 'Березняки'),
            array('name' => 'Букино'),
            array('name' => 'Быково'),
            array('name' => 'Ватутина'),
            array('name' => 'Войновка'),
            array('name' => 'Воровского'),
            array('name' => 'Воронино'),
            array('name' => 'Восточный 1 мкр.'),
            array('name' => 'Восточный 2 мкр.'),
            array('name' => 'Гилевское кольцо'),
            array('name' => 'Горьковское направление'),
            array('name' => 'Док'),
            array('name' => 'Дом Обороны'),
            array('name' => 'Зайково'),
            array('name' => 'Зарека'),
            array('name' => 'Заречный 1 мкр.'),
            array('name' => 'Заречный 2 мкр.'),
            array('name' => 'Заречный 3 мкр.'),
            array('name' => 'Заречный 4 мкр.'),
            array('name' => 'Казарово'),
            array('name' => 'Калинина'),
            array('name' => 'Комарово'),
            array('name' => 'КПД'),
            array('name' => 'Лесной мкр.'),
            array('name' => 'Лесобаза / мкр. Тур'),
            array('name' => 'Лесобаза / п. Этузиастов'),
            array('name' => 'Малахово'),
            array('name' => 'Матмассы'),
            array('name' => 'Маяк'),
            array('name' => 'Метелево'),
            array('name' => 'МЖК'),
            array('name' => 'ММС'),
            array('name' => 'Москвский дворик'),
            array('name' => 'Московского тр.'),
            array('name' => 'Мыс'),
            array('name' => 'Нефтяник'),
            array('name' => 'Ожогино / Патрушево'),
            array('name' => 'Парфенова'),
            array('name' => 'Петровский остров'),
            array('name' => 'Плеханово'),
            array('name' => 'Пос. Строителей'),
            array('name' => 'Рабочий поселок'),
            array('name' => 'Рощино'),
            array('name' => 'Светлый квартал'),
            array('name' => 'Славянский мкр.'),
            array('name' => 'СМП'),
            array('name' => 'Стрела'),
            array('name' => 'Студгородок'),
            array('name' => 'Суходолье'),
            array('name' => 'Тарманы'),
            array('name' => 'Три сосны'),
            array('name' => 'Труфаново'),
            array('name' => 'ТЭЦ-2'),
            array('name' => 'Тюменская слобода'),
            array('name' => 'Тюменский 2 мкр.'),
            array('name' => 'Тюменский 3 мкр.'),
            array('name' => 'Тюменский 4 мкр.'),
            array('name' => 'Тюменский микрорайон'),
            array('name' => 'Улицы Калинина'),
            array('name' => 'Улицы Чаплина'),
            array('name' => 'Утяшево'),
            array('name' => 'Учхоз'),
            array('name' => 'Центр'),
            array('name' => 'Цимлянское озеро'),
            array('name' => 'Червишевский тр.'),
            array('name' => 'Электрон'),
            array('name' => 'Югра'),
            array('name' => 'Южный микрорайон'),
            array('name' => 'Ялутр. тр. 11 км.'),
            array('name' => 'Ямальский')
        ));

        //streets
        $this->createTable('{{streets}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Улица'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        //categories
        $this->createTable('{{categories}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Улица'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{categories}}', array(
            array('name' => 'Вторичное жилье'),
            array('name' => 'Новостройки от застройщиков'),
            array('name' => 'Новостройки от дольщиков'),
        ));

        //wall_types
        $this->createTable('{{wall_types}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Тип'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{wall_types}}', array(
            array('name' => 'блоки'),
            array('name' => 'блоки+кирпич'),
            array('name' => 'дерево+кирпич'),
            array('name' => 'дерево'),
            array('name' => 'другое'),
            array('name' => 'каркасный'),
            array('name' => 'кирпич'),
            array('name' => 'монолит'),
            array('name' => 'панель'),
            array('name' => 'пенозаливной материал')
        ));

        //series
        $this->createTable('{{series}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Тип'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insertMultiple('{{series}}', array(
            array('name' => '121'),
            array('name' => '121 ЗТ'),
            array('name' => '121 7Т'),
            array('name' => '121 Т'),
            array('name' => '121/12'),
            array('name' => '121/14'),
            array('name' => '121/7ТМ'),
            array('name' => '125'),
            array('name' => '125 Т'),
            array('name' => '83'),
            array('name' => '86'),
            array('name' => 'Болгарский'),
            array('name' => 'Брежневка'),
            array('name' => 'Грузинский'),
            array('name' => 'Индивид.'),
            array('name' => 'Киевский'),
            array('name' => 'Комфорт 9П'),
            array('name' => 'Коридорный'),
            array('name' => 'Лен. проект'),
            array('name' => 'Малосемейка'),
            array('name' => 'Общежитие'),
            array('name' => 'Пансиона'),
            array('name' => 'Свердловский'),
            array('name' => 'Сталинка'),
            array('name' => 'Таджикский'),
            array('name' => 'Таунхауз'),
            array('name' => 'Трехлистник'),
            array('name' => 'Туркменский'),
            array('name' => 'Хрущевка'),
            array('name' => 'Ярославски')
        ));
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