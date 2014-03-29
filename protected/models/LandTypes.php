<?php

/**
* This is the model class for table "{{land_types}}".
*
* The followings are the available columns in table '{{land_types}}':
    * @property integer $id
    * @property string $name
*/
class LandTypes extends EActiveRecord
{
    public function tableName()
    {
        return '{{land_types}}';
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
        return 'Типы загородной недвижимости';
    }


}
