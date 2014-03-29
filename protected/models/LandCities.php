<?php

/**
* This is the model class for table "{{land_cities}}".
*
* The followings are the available columns in table '{{land_cities}}':
    * @property integer $id
    * @property string $name
*/
class LandCities extends EActiveRecord
{
    public function tableName()
    {
        return '{{land_cities}}';
    }


    public function rules()
    {
        return array(
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'localities' => array(self::HAS_MANY, 'LandLocalities', 'city_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Значение',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
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
        return 'Города, районы';
    }


}
