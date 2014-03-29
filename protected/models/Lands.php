<?php

/**
* This is the model class for table "{{lands}}".
*
* The followings are the available columns in table '{{lands}}':
    * @property integer $id
    * @property integer $way_id
    * @property integer $city_id
    * @property integer $locality_id
    * @property integer $type_id
    * @property integer $state_id
    * @property string $square
    * @property integer $material_id
    * @property integer $target_id
    * @property string $price
    * @property integer $gllr_images
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Lands extends EActiveRecord
{
    public function tableName()
    {
        return '{{lands}}';
    }


    public function rules()
    {
        return array(
            array('way_id, city_id, locality_id, type_id, state_id, material_id, target_id, gllr_images, seo_id, status, sort, user_id', 'numerical', 'integerOnly'=>true),
            array('square', 'length', 'max'=>8),
            array('price', 'length', 'max'=>10),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, way_id, city_id, locality_id, type_id, state_id, square, material_id, target_id, price, gllr_images, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'way' => array(self::BELONGS_TO, 'LandWays', 'way_id'),
            'city' => array(self::BELONGS_TO, 'LandCities', 'city_id'),
            'locality' => array(self::BELONGS_TO, 'LandLocalities', 'type_id'),
            'type' => array(self::BELONGS_TO, 'LandTypes', 'way_id'),
            'state' => array(self::BELONGS_TO, 'LandStates', 'state_id'),
            'material' => array(self::BELONGS_TO, 'LandMaterials', 'material_id'),
            'target' => array(self::BELONGS_TO, 'LandTargets', 'target_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'way_id' => 'Направление',
            'city_id' => 'Город, район',
            'locality_id' => 'Населенный пункт',
            'type_id' => 'Тип',
            'state_id' => 'Состояние',
            'square' => 'Площадь (кв.м.)',
            'material_id' => 'Материал',
            'target_id' => 'Назначение земли',
            'price' => 'Цена',
            'gllr_images' => 'Галерея',
            'seo_id' => 'SEO',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
            'galleryBehaviorImages' => array(
                'class' => 'appext.imagesgallery.GalleryBehavior',
                'idAttribute' => 'gllr_images',
                'versions' => array(
                    'small' => array(
                        'adaptiveResize' => array(90, 90),
                    ),
                    'medium' => array(
                        'resize' => array(600, 500),
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
		$criteria->compare('way_id',$this->way_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('locality_id',$this->locality_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('square',$this->square,true);
		$criteria->compare('material_id',$this->material_id);
		$criteria->compare('target_id',$this->target_id);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('gllr_images',$this->gllr_images);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
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
        return 'Загородная недвижимость';
    }

    public function afterFind(){
        parent::afterFind();

        $this->price = number_format($this->price, 0, '', '');
    }
}
