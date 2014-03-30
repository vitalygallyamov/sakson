<?php

/**
* This is the model class for table "{{pages}}".
*
* The followings are the available columns in table '{{pages}}':
    * @property integer $id
    * @property string $name
    * @property string $url
    * @property string $menu_name
    * @property integer $menu_public
    * @property string $wswg_content
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Page extends EActiveRecord
{
    const NOT_MENU_PUBLIC = 0;
    const MENU_PUBLIC = 1;

    public function __get($name){
        if($name == "active"){
            if(isset($_GET["url"]) && $_GET["url"] == $this->url)
                return "active";
            return null;
        }
        if($name == "show_name"){
            if($this->menu_public && !empty($this->menu_name))
                return $this->menu_name;
            return $this->name;
        }
        return parent::__get($name);
    }

    public function tableName()
    {
        return '{{pages}}';
    }

    public function defaultScope(){
        return array(
            'order'=>'sort ASC',
        );
    }

    public function rules()
    {
        return array(
            array('name, url', 'required'),
            array('url', 'match', 'pattern'=>'/[A-Za-z0-9-_\/]/', 'message'=>'URL должен содержать только английские буквы'),
            array('menu_public, seo_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('name, url, menu_name', 'length', 'max'=>255),
            array('wswg_content, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, url, menu_name, menu_public, wswg_content, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'URL',
            'menu_name' => 'Название в меню',
            'menu_public' => 'Показывать в меню',
            'wswg_content' => 'Контент',
            'seo_id' => 'Seo',
            'status' => 'Статус',
            'sort' => 'Вес сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
			),
			'Seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('menu_public',$this->menu_public);
		$criteria->compare('wswg_content',$this->wswg_content,true);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort ASC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Страницы';
    }

    public static function getMenuStatusLabel($statusId = null){
        $label = array(
            self::NOT_MENU_PUBLIC=>"Нет",
            self::MENU_PUBLIC=>"Да",
        );
        if($statusId === null || !is_numeric($statusId))
            return $label;

        return $label[$statusId];
    }
}
