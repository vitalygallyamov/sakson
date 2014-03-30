<?php

/**
* This is the model class for table "{{partners}}".
*
* The followings are the available columns in table '{{partners}}':
    * @property integer $id
    * @property string $img_logo
    * @property string $name
    * @property string $desc
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Partner extends EActiveRecord
{
    public $imgLogo;

    public function tableName()
    {
        return '{{partners}}';
    }

    public function defaultScope(){
        return array(
            'order'=>'sort ASC',
        );
    }

    public function rules()
    {
        return array(
            array('img_logo, name, desc', 'required'),
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('img_logo, name', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, img_logo, name, desc, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
            'img_logo' => 'Логотип партнера',
            'name' => 'Название компании',
            'desc' => 'Описание',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        	'imgBehaviorLogo' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_logo',
				'versions' => array(
					'normal' => array(
						'resize' => array(200, 60),
					),
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
		$criteria->compare('img_logo',$this->img_logo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);
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
        return 'Партнеры';
    }

    public function beforeValidate(){
        $this->imgLogo = $this->img_logo;
        return true;
    }

    public function afterValidate(){
        $this->img_logo = $this->imgLogo;
        return true;
    }
}
