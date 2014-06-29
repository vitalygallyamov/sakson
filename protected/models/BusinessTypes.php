<?php

/**
* This is the model class for table "{{business_types}}".
*
* The followings are the available columns in table '{{business_types}}':
    * @property integer $id
    * @property string $type
    * @property integer $parent
*/
class BusinessTypes extends EActiveRecord
{
    public function defaultScope(){

        return array(
            'order' => 'type'
        );
    }

    public function tableName()
    {
        return '{{business_types}}';
    }


    public function rules()
    {
        return array(
            array('parent', 'numerical', 'integerOnly'=>true),
            array('type', 'length', 'max'=>255),
            // The following rule is used by search().
            array('id, type, parent', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'children' => array(self::HAS_MANY, 'BusinessTypes', 'parent')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Тип',
            'parent' => 'Родительский тип',
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('parent',$this->parent);
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
        return 'Типы бизнесов';
    }

    public static function getRootTypes(){
        return self::model()->findAll('parent=0');
    }
}
