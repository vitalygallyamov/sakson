<?php

class StatisticsController extends AdminController
{
	public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                // 'actions' => array('list', 'create', 'update', ''),
                'roles'=>array('admin'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
	
	public function actionList(){
		$data = array();

		$start = new DateTime();

		//init dates
		$data['end'] = $start->format('d.m.Y');
		$data['start'] = clone $start;

		$data['start'] = $data['start']->modify('-7 days')->format('d.m.Y');

		if(isset($_POST['Dates'])){

			if($_POST['Dates']['from'] && $_POST['Dates']['to']){

				$date_from = new DateTime($_POST['Dates']['from']);
				$date_from = $date_from->format('Y-m-d H:i:s');

				$date_to = new DateTime($_POST['Dates']['to']);

				$date_to->modify('+1 day')->modify('-1 second');
				$date_to = $date_to->format('Y-m-d H:i:s');

				//find agents
				$agents = Yii::app()->db->createCommand()
					->select('users.id, fio')
					->from('{{admin_users}} as users')
					->join('{{AuthAssignment}} as aa', 'users.id=aa.userid')
					->where('aa.itemname=:name', array(':name'=>'agent'))
					->queryAll();

				foreach ($agents as $key => $agent) {
					$data['result'][$key]['agent'] = $agent['fio'];	

					//apartments
					$criteria = new CDbCriteria;
					$criteria->compare('agent_id', $agent['id']);
					$criteria->addCondition('create_time >= :from');
					$criteria->addCondition('create_time <= :to');

					$criteria->params[':from'] = $date_from;
					$criteria->params[':to'] = $date_to;

					$data['result'][$key]['apartments_count'] = Apartments::model()->count($criteria);

					//lands
					$criteria = new CDbCriteria;
					$criteria->compare('user_id', $agent['id']);
					$criteria->addCondition('create_time >= :from');
					$criteria->addCondition('create_time <= :to');

					$criteria->params[':from'] = $date_from;
					$criteria->params[':to'] = $date_to;

					$data['result'][$key]['lands_count'] = Lands::model()->count($criteria);
				}
			}
		}

		$this->render('index', array('data' => $data));
	}
}