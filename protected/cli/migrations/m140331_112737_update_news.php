<?php
/**
 * Миграция m140331_112737_update_news
 *
 * @property string $prefix
 */
 
class m140331_112737_update_news extends CDbMigration
{
 
    public function safeUp()
    {
        $this->addColumn("tbl_news", "url", "varchar(255) not null");
        $news = Yii::app()->db->createCommand("SELECT * FROM tbl_news")->queryAll();
        foreach($news as $n){
            $this->update("tbl_news", array("url"=>SiteHelper::url($n["name"])),"id={$n["id"]}");
        }
    }
 
    public function safeDown()
    {
        $this->dropColumn("tbl_news", "url");
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