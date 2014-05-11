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
    public $fastDelete = true;

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
            array('login, email', 'required'),
            array('pass', 'required', 'on' => 'create'),
            array('login, email', 'unique'),
            array('login', 'length', 'min' => 5, 'max' => 25),
            array('pass', 'length', 'min' => 5),
            array('login', 'match', 'pattern' => '/^[a-z0-9_]+$/i', 'message' => 'Логин должен содержать только латинские буквы, цифры и знак подчеркивания.'),
            array('email', 'email'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('fio, login, pass, email, phone', 'length', 'max'=>255),
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
            'phone' => 'Телефон',
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
		$criteria->compare('phone',$this->phone,true);
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

    public function getRole(){
        $roles = self::getRoles();

        return $roles[$this->role];
    }

    public static function getRoles(){
        return array(
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_AGENT => 'Агент'
        );
    }

    public static function getStatusAliases($status = -1)
    {
        $aliases = array(
            parent::STATUS_CLOSED => 'Закрыт доступ',
            parent::STATUS_PUBLISH => 'Открыт доступ',
        );

        if ($status > -1)
            return $aliases[$status];

        return $aliases;
    }

    public function beforeSave(){

        if($this->pass && $this->isNewRecord){
            $this->pass = $this->hashPassword($this->pass);
        }

        return parent::beforeSave();
    }

    public function afterSave(){
        $authMahager = Yii::app()->authManager;

        if($this->role){
            $assignments = $authMahager->getAuthAssignments($this->id);
            if(!empty($assignments)){
                foreach ($assignments as $key => $value) {
                    //$this->role = $key;
                    $authMahager->revoke($key, $this->id);
                }
                // $this->role = $authAssignment->itemName;
            }
            $authMahager->assign($this->role, $this->id);
        }

        parent::afterSave();
    }

    public function afterFind(){
        parent::afterFind();

        foreach (Yii::app()->authManager->getAuthAssignments($this->id) as $key => $value) {
            $this->role = $key;
        }
    }

    public static function getAgents(){
        $agents = Yii::app()->db->createCommand()
            ->select('au.id, au.fio')
            ->from('{{admin_users}} as au')
            ->join('{{AuthAssignment}} as aa', 'au.id=aa.userid')
            ->where('aa.itemname="agent"')
            ->queryAll();

        $result = array();
        foreach ($agents as $agent) {
            $result[$agent['id']] = $agent['fio'];
        }

        return $result;
    }
}
