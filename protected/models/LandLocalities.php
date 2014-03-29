<?php

/**
* This is the model class for table "{{land_localities}}".
*
* The followings are the available columns in table '{{land_localities}}':
    * @property integer $id
    * @property string $name
    * @property integer $city_id
*/
class LandLocalities extends EActiveRecord
{
    public function tableName()
    {
        return '{{land_localities}}';
    }


    public function rules()
    {
        return array(
            array('city_id', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, name, city_id', 'safe', 'on'=>'search'),
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
            'name' => 'Значение',
            'city_id' => 'Район',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('city_id',$this->city_id);
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
        return 'Населенные пункты';
    }


}
