<?php

/**
* This is the model class for table "{{admin_users}}".
*
* The followings are the available columns in table '{{admin_users}}':
    * @property integer $id
    * @property string $fio
    * @property string $login
    * @property string $pass
    * @property string $email
    * @property integer $status
    * @property string $create_time
    * @property string $update_time
*/
class AdminUser extends EActiveRecord
{

    public $role = false;

    const ROLE_ADMIN = 'admin';
    const ROLE_AGENT = 'agent';

    public function tableName()
    {
        return '{{admin_users}}';
    }


    public function rules()
    {
        return array(
            array('login, pass, email', 'required'),
            array('login, email', 'unique'),
            array('login, pass', 'length', 'min' => 5, 'max' => 25),
            array('login', 'match', 'pattern' => '/^[a-z0-9_]+$/i', 'message' => 'Логин должен содержать только латинские буквы, цифры и знак подчеркивания.'),
            array('email', 'email'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('fio, login, pass, email', 'length', 'max'=>255),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, fio, login, pass, email, status, create_time, update_time', 'safe', 'on'=>'search'),
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
            'fio' => 'ФИО',
            'login' => 'Логин',
            'pass' => 'Пароль',
            'email' => 'E-mail',
            'status' => 'Статус',
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
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);
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
        return 'Пользователи системы';
    }

    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->pass);
    }
 
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

    public static function getRoles(){
        return array(
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_AGENT => 'Агент'
        );
    }

    public function getRole(){
        // $roles = self::getRoles();

        // return $roles[$this->]
    }

    public function beforeSave(){

        if($this->pass){
            $this->pass = $this->hashPassword($this->pass);
        }

        return parent::beforeSave();
    }

    public function afterSave(){
        $authMahager = Yii::app()->authManager;

        $assignments = $authMahager->getAuthAssignments($this->id);

        // print_r($assignments); die();
        if(!empty($assignments)){
            foreach ($assignments as $key => $value) {
                $authMahager->revoke($key, $this->id);
            }
            // $this->role = $authAssignment->itemName;
        }

        if(!$authMahager->isAssigned($this->role, $this->id)){
            $authMahager->assign($this->role, $this->id);
        }else{
            $authMahager->revoke($this->role, $this->id);
            $authMahager->assign($this->role, $this->id);
        }

        parent::afterSave();
    }
}