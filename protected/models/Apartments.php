<?php

/**
* This is the model class for table "{{apartments}}".
*
* The followings are the available columns in table '{{apartments}}':
    * @property integer $id
    * @property integer $apartment_type_id
    * @property integer $area_id
    * @property integer $street_id
    * @property string $house
    * @property integer $category_id
    * @property integer $floor
    * @property integer $house_floors
    * @property string $square
    * @property string $kitchen_area
    * @property integer $walls_type_id
    * @property integer $series_id
    * @property string $price_1m
    * @property string $price_agency
    * @property string $price
    * @property string $desc
    * @property integer $gllr_photos
    * @property integer $agent_id
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Apartments extends EActiveRecord
{
    public $priceBegin;
    public $priceEnd;

    const APART_HOT = 1;
    const APART_VIP = 2;
    const APART_IPOTEKA = 3;

    public static function deleteReasons($reason = -1)
    {
        $aliases = array(
            1 => 'Продана самостоятельно,',
            2 => 'Продана другим агентством',
            3 => 'Продана АН «САКСОН»',
            4 => 'Снята с продажи.'
            //parent::STATUS_REMOVED => 'Удалено',
        );

        if ($reason > -1)
            return $aliases[$reason];

        return $aliases;
    }

    public static function getStatusAliasesCart($status = -1)
    {
        $aliases = array(
            parent::STATUS_CLOSED => 'Не опубликовано',
            parent::STATUS_PUBLISH => 'Опубликовано',
            parent::STATUS_REMOVED => 'Удалено',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            parent::STATUS_CLOSED => 'Не опубликовано',
            parent::STATUS_PUBLISH => 'Опубликовано',
            //parent::STATUS_REMOVED => 'Удалено',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    /*public function defaultScope()
    {
        return array(
            'condition'=>"status!=".parent::STATUS_REMOVED,
        );
    }*/

    public function tableName()
    {
        return '{{apartments}}';
    }

    public function rules()
    {
        return array(
            array('price', 'required'),
            array('apartment_type_id, area_id, street_id, category_id, floor, house_floors, walls_type_id, series_id, gllr_photos, agent_id, seo_id, status, sort, delete_reason, room_num', 'numerical', 'integerOnly'=>true),
            array('house', 'length', 'max'=>20),
            array('added', 'length', 'max'=>40),
            array('square, kitchen_area', 'length', 'max'=>8),
            array('price_1m, price_agency, price', 'length', 'max'=>10),
            array('desc, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, apartment_type_id, area_id, street_id, house, category_id, floor, house_floors, square, kitchen_area, walls_type_id, series_id, price_1m, price_agency, price, desc, gllr_photos, agent_id, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'apartment_types' => array(self::BELONGS_TO, 'ApartmentTypes', 'apartment_type_id'),
            'area' => array(self::BELONGS_TO, 'Areas', 'area_id'),
            'street' => array(self::BELONGS_TO, 'Streets', 'street_id'),
            'wall' => array(self::BELONGS_TO, 'WallTypes', 'walls_type_id'),
            'series' => array(self::BELONGS_TO, 'Series', 'series_id'),
            'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
            'deleteAparts' => array(self::HAS_MANY, 'DeleteApartments', 'apart_id'),
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gllr_photos',
                'with'=>array(
                    'galleryPhotos'=>array(),
                ),
            ),
            'user' => array(self::BELONGS_TO, 'AdminUser', 'agent_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'apartment_type_id' => 'Тип квартиры',
            'area_id' => 'Район',
            'street_id' => 'Улица',
            'house' => 'Дом',
            'category_id' => 'Категория',
            'floor' => 'Этаж',
            'house_floors' => 'Этажность дома',
            'square' => 'Площадь',
            'kitchen_area' => 'Площадь кухни',
            'walls_type_id' => 'Стены',
            'series_id' => 'Серия',
            'price_1m' => 'Стоимость 1 кв.м.',
            'price_agency' => 'Стоимость услуг агенства',
            'price' => 'Стоимость',
            'desc' => 'Описание',
            'added' => 'Дополнительно',
            'gllr_photos' => 'Изображения',
            'agent_id' => 'Агент',
            'seo_id' => 'SEO раздел',
            'status' => 'Статус',
            'delete_reason' => 'Причина удаления',
            'room_num' => 'Номер квартиры',
            'sort' => 'Вес для сортировки',
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
						'adaptiveResize' => array(140, 180),
					),
					'medium' => array(
						'resize' => array(600, 500),
					),
                    'big' => array(
                        'resize' => array(1000, 1000),
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
			'Seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }
    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('apartment_type_id',$this->apartment_type_id);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('street_id',$this->street_id);
		$criteria->compare('house',$this->house,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('floor',$this->floor);
		$criteria->compare('house_floors',$this->house_floors);
		$criteria->compare('square',$this->square,true);
		$criteria->compare('kitchen_area',$this->kitchen_area,true);
		$criteria->compare('walls_type_id',$this->walls_type_id);
		$criteria->compare('series_id',$this->series_id);
		$criteria->compare('price_1m',$this->price_1m,true);
		$criteria->compare('price_agency',$this->price_agency,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('gllr_photos',$this->gllr_photos);
        //$criteria->compare('agent_id',$this->agent_id);
        $criteria->compare('delete_reason',$this->delete_reason);
		$criteria->compare('room_num',$this->room_num);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

        if(!Yii::app()->user->checkAccess('admin')){
            $criteria->addCondition('agent_id=:agent_id');
            $criteria->params[':agent_id'] = Yii::app()->user->id;
        }

        $criteria->addCondition('status!=:s');
        $criteria->params[':s'] = parent::STATUS_REMOVED;

        if($this->priceBegin && $this->priceEnd){
            $criteria->addBetweenCondition('price', $this->priceBegin, $this->priceEnd);
        }

        $criteria->order = 'create_time DESC, sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function isNew(){
        if($this->create_time){
            $now = new DateTime();
            $create = new DateTime($this->create_time);
           
            $interval = $now->diff($create);
            $interval = (int) $interval->format('%a');
            
            return $interval <= 7;
        }
    }

    public static function addedList(){
        return array(
            self::APART_HOT => 'Срочно',
            self::APART_VIP => 'VIP',
            self::APART_IPOTEKA => 'Ипотека'
        );
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Квартиры';
    }

    public function afterFind(){
        parent::afterFind();

        $this->price = number_format($this->price, 0, '', '');
        $this->price_agency = number_format($this->price_agency, 0, '', '');
        $this->price_1m = number_format($this->price_1m, 0, '', '');
    }

    public function beforeValidate(){

        if($this->added && is_array($this->added)){
            $this->added = implode(',', $this->added);
        }else
            $this->added = '';

        return parent::beforeValidate();
    }

    public function checkAccess(){
        if($this->isNewRecord)
            return true;

        if(Yii::app()->user->checkAccess('admin')) 
            return true;

        if(Yii::app()->user->checkAccess('agent') && Yii::app()->user->id == $this->agent_id)
            return true;

        return false;
    }
}
