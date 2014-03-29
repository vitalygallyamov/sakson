<?php
/**
 * Миграция m140329_183648_insert_pages
 *
 * @property string $prefix
 */
 
class m140329_183648_insert_pages extends CDbMigration
{
    public function safeUp()
    {
        $this->insertMultiple("tbl_pages", array(
            array(
                'id'=>1,
                'name'=>'Главная',
                'url'=>'/',
                'menu_name'=>'Главная',
                'menu_public'=>1,
                'wswg_content'=>'<div class="block half"><h3>Саксон</h3>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium qu is, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus</div><div class="block half"><h3>Кратко</h3>Открытость, честность, профессионализм - это девиз АН &quot;САКСОН&quot;. Мы работаем для того, чтобы предложить покупателям широкий выбор объектов недвижимости в Тюмени и Тюменской области. В нашей базе размещены сотни предложений от застройщиков и частных владельцев.</div><div class="clear">&nbsp;</div><!-- Наши преимущества --><div class="block"><h3>Наши преимущества</h3><div class="dost"><img src="/media/images/dost_1.png" /><div class="clear">&nbsp;</div>Новостройки и вторичка без коммисии для покупателей</div><div class="dost"><img src="/media/images/dost_2.png" /><div class="clear">&nbsp;</div>Фиксированная коммисия для продавцов</div><div class="dost"><img src="/media/images/dost_3.png" /><div class="clear">&nbsp;</div>Лицензированный оценщик</div><div class="dost"><img src="/media/images/dost_4.png" /><div class="clear">&nbsp;</div>VIP сопровождение сделки</div></div>',
                'seo_id'=>1,
                'status'=>1,
                'sort'=>1000,
                'create_time'=>'2014-03-29 19:36:38',
                'update_time'=>'2014-03-29 23:53:33'),
            array(
                'id'=>2,
                'name'=>'Каталог',
                'url'=>'catalog',
                'menu_name'=>'Каталог',
                'menu_public'=>1,
                'wswg_content'=>'',
                'seo_id'=>2,
                'status'=>1,
                'sort'=>10,
                'create_time'=>'2014-03-29 21:22:58',
                'update_time'=>'2014-03-29 23:16:03'),
            array(
                'id'=>3,
                'name'=>'Новости',
                'url'=>'news',
                'menu_name'=>'Новости',
                'menu_public'=>1,
                'wswg_content'=>'',
                'seo_id'=>3,
                'status'=>1,
                'sort'=>9,
                'create_time'=>'2014-03-29 21:25:41',
                'update_time'=>NULL),
            array(
                'id'=>4,
                'name'=>'О компании',
                'url'=>'about',
                'menu_name'=>'О компании',
                'menu_public'=>1,
                'wswg_content'=>'<h3>О компании</h3><p>Типичный текст Типичный текст Типичный текст Типичный текст Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus... Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus... Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus... Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus... Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus...</p><p>Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus... Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus...</p>',
                'seo_id'=>4,
                'status'=>1,
                'sort'=>7,
                'create_time'=>'2014-03-29 21:26:24',
                'update_time'=>'2014-03-30 00:00:37'),
        ));

        $this->insertMultiple("tbl_seo", array(
            array(1, NULL, NULL, NULL, NULL),
            array(2, NULL, NULL, NULL, NULL),
            array(3, NULL, NULL, NULL, NULL),
            array(4, NULL, NULL, NULL, NULL),
        ));
    }
 
    public function safeDown()
    {
        $this->truncateTable("tbl_pages");
        $this->truncateTable("tbl_seo");
    }
}