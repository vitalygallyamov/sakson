<?php

/**
* This is the model class for table "{{delete_apartments}}".
*
* The followings are the available columns in table '{{delete_apartments}}':
    * @property integer $id
    * @property integer $apart_id
    * @property integer $user_id
    * @property string $comment
    * @property string $create_time
    * @property string $update_time
*/
class DeleteApartments extends EActiveRecord
{
    public function tableName()
    {
        return '{{delete_apartments}}';
    }


    public function rules()
    {
        return array(
            array('comment', 'required'),
            array('apart_id, user_id', 'numerical', 'integerOnly'=>true),
            array('comment, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, apart_id, user_id, comment, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'AdminUser', 'user_id')
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'apart_id' => 'Квартира',
            'user_id' => 'Пользователь',
            'comment' => 'Комментарий',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
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
		$criteria->compare('apart_id',$this->apart_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
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
        return 'Удаленные квартиры';
    }


}
