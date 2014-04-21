<?php

/**
* This is the model class for table "{{streets}}".
*
* The followings are the available columns in table '{{streets}}':
    * @property integer $id
    * @property string $name
*/
class Streets extends EActiveRecord
{
    public function tableName()
    {
        return '{{streets}}';
    }


    public function rules()
    {
        return array(
            array('city_id', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('name', 'unique'),
            // The following rule is used by search().
            array('id, name', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'city' => array(self::BELONGS_TO, 'Cities', 'city_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Улица',
            'city_id' => 'Город',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

        $criteria->order = 'name';
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
        return 'Улицы';
    }


}
