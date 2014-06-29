<?php

/**
* This is the model class for table "{{business}}".
*
* The followings are the available columns in table '{{business}}':
    * @property integer $id
    * @property integer $way_id
    * @property integer $locality_id
    * @property integer $street_id
    * @property integer $house_num
    * @property integer $room_num
    * @property string $square
    * @property integer $type_id
    * @property integer $sub_type_id
    * @property integer $state_id
    * @property string $price
    * @property string $limit
    * @property string $phone_own
    * @property integer $gllr_images
    * @property integer $seo_id
    * @property integer $user_id
    * @property string $desc
    * @property string $comment
    * @property integer $delete_reason
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Business extends EActiveRecord
{
    public function tableName()
    {
        return '{{business}}';
    }


    public function rules()
    {
        return array(
            array('way_id, locality_id, street_id, house_num, type_id, state_id, price, limit, phone_own, desc, comment', 'required'),
            array('way_id, locality_id, street_id, house_num, room_num, type_id, sub_type_id, state_id, gllr_images, seo_id, user_id, delete_reason, status, sort', 'numerical', 'integerOnly'=>true),
            array('square', 'length', 'max'=>8),
            array('price', 'length', 'max'=>10),
            array('limit', 'length', 'max'=>30),
            array('phone_own', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, way_id, locality_id, street_id, house_num, room_num, square, type_id, sub_type_id, state_id, price, limit, phone_own, gllr_images, seo_id, user_id, desc, comment, delete_reason, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'way' => array(self::BELONGS_TO, 'LandWays', 'way_id'),
            'locality' => array(self::BELONGS_TO, 'LandLocalities', 'locality_id'),
            'type' => array(self::BELONGS_TO, 'BusinessTypes', 'type_id'),
            'sub_type' => array(self::BELONGS_TO, 'BusinessTypes', 'sub_type_id'),
            'state' => array(self::BELONGS_TO, 'LandStates', 'state_id'),
            'street' => array(self::BELONGS_TO, 'Streets', 'street_id'),
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gllr_images'),
            'user' => array(self::BELONGS_TO, 'AdminUser', 'user_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'way_id' => 'Направление',
            'locality_id' => 'Населенный пункт',
            'street_id' => 'Улица',
            'house_num' => 'Номер дома',
            'room_num' => 'Номер квартиры',
            'square' => 'Площадь помещения (кв.м.)',
            'type_id' => 'Тип',
            'sub_type_id' => 'Под тип',
            'state_id' => 'Состояние',
            'price' => 'Цена',
            'limit' => 'Предел торга',
            'phone_own' => 'Телефон собственника',
            'gllr_images' => 'Галерея',
            'seo_id' => 'SEO',
            'user_id' => 'Агент',
            'desc' => 'Описание',
            'comment' => 'Комментарий',
            'delete_reason' => 'Причина удаления',
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
                        'adaptiveResize' => array(140, 180),
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

    /*public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('way_id',$this->way_id);
		$criteria->compare('locality_id',$this->locality_id);
		$criteria->compare('street_id',$this->street_id);
		$criteria->compare('house_num',$this->house_num);
		$criteria->compare('room_num',$this->room_num);
		$criteria->compare('square',$this->square,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('sub_type_id',$this->sub_type_id);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('limit',$this->limit,true);
		$criteria->compare('phone_own',$this->phone_own,true);
		$criteria->compare('gllr_images',$this->gllr_images);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('delete_reason',$this->delete_reason);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }*/

    private function getCommonCriteria(){
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('way_id',$this->way_id);
        $criteria->compare('locality_id',$this->locality_id);
        $criteria->compare('street_id',$this->street_id);
        $criteria->compare('house_num',$this->house_num);
        $criteria->compare('room_num',$this->room_num);
        $criteria->compare('square',$this->square,true);
        // $criteria->compare('type_id',$this->type_id);
        // $criteria->compare('sub_type_id',$this->type_id);
        $criteria->compare('state_id',$this->state_id);
        $criteria->compare('price',$this->price,true);
        $criteria->compare('limit',$this->limit,true);
        $criteria->compare('phone_own',$this->phone_own,true);
        $criteria->compare('gllr_images',$this->gllr_images);
        $criteria->compare('seo_id',$this->seo_id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('desc',$this->desc,true);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('delete_reason',$this->delete_reason);
        $criteria->compare('status',$this->status);

        //types
        if($this->type_id){
            $type = BusinessTypes::model()->findByPk($this->type_id);
            if($type->parent == 0)
                $criteria->compare('type_id',$this->type_id);
            elseif ($type->parent > 0)
                $criteria->compare('sub_type_id',$this->type_id);
        }

        $criteria->addCondition('status!=:s');
        $criteria->params[':s'] = parent::STATUS_REMOVED;

        $criteria->order = 'create_time DESC, sort';

        return $criteria;
    }

    public function search()
    {
        $criteria = $this->getCommonCriteria();

        if(!Yii::app()->user->checkAccess('admin')){
            $criteria->addCondition('user_id=:user_id');
            $criteria->params[':user_id'] = Yii::app()->user->id;
        }

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => false
        ));
    }

    public function searchNotOwn(){
        $criteria = $this->getCommonCriteria();

        if(!Yii::app()->user->checkAccess('admin')){
            $criteria->addCondition('user_id!=:user_id');
            $criteria->params[':user_id'] = Yii::app()->user->id;
        }

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => false
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function translition()
    {
        return 'Для бизнеса';
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

    public function beforeValidate(){

        if($this->isNewRecord){
            $same = self::model()->find('way_id=:way_id AND street_id=:street_id AND house_num=:house_num AND room_num=:room_num', array(
                ':way_id' => $this->way_id,
                ':street_id' => $this->street_id,
                ':house_num' => $this->house_num,
                ':room_num' => $this->room_num
            ));

            if($same){
                $this->addError('', 'Объект уже существует!');
            }
        }

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

    public function isOwn(){
        if(Yii::app()->user->checkAccess('admin')) return true;
        if(Yii::app()->user->id == $this->user_id) return true;

        return false;
    }

    public function getTypeName(){
        return $this->type ?
            $this->type->type.($this->sub_type ? " - ".$this->sub_type->type : "") : "";
    }
}
