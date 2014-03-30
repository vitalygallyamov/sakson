<?php

/**
* This is the model class for table "{{slider}}".
*
* The followings are the available columns in table '{{slider}}':
    * @property integer $id
    * @property string $img_photo
    * @property string $content
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Slider extends EActiveRecord
{
    public $imgPhoto;

    public function tableName()
    {
        return '{{slider}}';
    }


    public function rules()
    {
        return array(
            array('img_photo', 'required'),
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('img_photo, content', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, img_photo, content, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'img_photo' => 'Изображение',
            'content' => 'Текст',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'imgBehaviorPhoto' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_photo',
				'versions' => array(
                    'icon' => array(
                        'adaptiveResize' => array(0, 90),
                    ),
					'normal' => array(
						'adaptiveResize' => array(0, 215),
					)
				),
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
		$criteria->compare('img_photo',$this->img_photo,true);
		$criteria->compare('content',$this->content,true);
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
        return 'Слайдер';
    }

    public function beforeValidate(){
        $this->imgPhoto = $this->img_photo;
        return true;
    }

    public function afterValidate(){
        $this->img_photo = $this->imgPhoto;
        return true;
    }
}
