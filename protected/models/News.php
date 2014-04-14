<?php

/**
* This is the model class for table "{{news}}".
*
* The followings are the available columns in table '{{news}}':
    * @property integer $id
    * @property string $name
    * @property integer $gllr_photos
    * @property string $dt_date
    * @property string $wswg_content
    * @property string $author
    * @property integer $status
    * @property string $create_time
    * @property string $update_time
*/
class News extends EActiveRecord
{
    public $fastDelete = true;

    public function tableName()
    {
        return '{{news}}';
    }

    public function rules()
    {
        return array(
            array('gllr_photos, status', 'numerical', 'integerOnly'=>true),
            array('name, author', 'length', 'max'=>255),
            array('name', 'unique'),
            array('name, author, dt_date', 'required'),
            array('dt_date, wswg_content, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, url, gllr_photos, dt_date, wswg_content, author, status, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'gallery'=>array(self::BELONGS_TO, "Gallery", "gllr_photos"),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Заголовок',
            'gllr_photos' => 'Изображения',
            'dt_date' => 'Дата',
            'wswg_content' => 'Контент',
            'author' => 'Автор',
            'status' => 'Статус',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }

    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
            'galleryBehaviorPhotos' => array(
				'class' => 'appext.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gllr_photos',
				'versions' => array(
					'small' => array(
						'adaptiveResize' => array(60, 40),
					),
                    'normal' => array(
                        'resize' => array(200, 150),
                    ),
					'big' => array(
						'resize' => array(600, 400),
					)
				),
				'name' => true,
				'description' => true,
			),
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gllr_photos',$this->gllr_photos);
		$criteria->compare('dt_date',$this->dt_date,true);
		$criteria->compare('wswg_content',$this->wswg_content,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = "dt_date DESC";
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
        return 'Новости';
    }

    public function __get($name){
        if($name ==  "day")
            return date("d", strtotime($this->dt_date));
        if($name == "month")
            return SiteHelper::russianMonth(date("m", strtotime($this->dt_date)));
        if($name == "year")
            return date("Y", strtotime($this->dt_date));
        if($name == "preview_content")
            return $this->getPreviewContent();
        return parent::__get($name);
    }

	public function beforeSave()
	{
        $this->url = SiteHelper::url($this->name);
		if (!empty($this->dt_date))
			$this->dt_date = Yii::app()->date->toMysql($this->dt_date);
		return parent::beforeSave();
	}

	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) { 
			$this->dt_date = ($this->dt_date !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_date)) : '';
		}
	}

    public function getPreviewContent(){
        $content = strip_tags($this->wswg_content);
        if(strlen($content)>100)
            return mb_substr($content, 0, 100);
        return $content;
    }

    public function getImageUrl($version = "small"){
        $photos = $this->gallery->galleryPhotos;
        if(!$photos){
            if($version === "small")
                return "http://placehold.it/60x40";
            if($version === "normal")
                return "http://placehold.it/200x160";
            if($version === "big")
                return "http://placehold.it/600x400";
        }
        return $photos[0]->getUrl($version);
    }
}
