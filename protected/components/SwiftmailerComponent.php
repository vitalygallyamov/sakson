<?php
class SwiftmailerComponent extends CApplicationComponent
{

	public $host = 'smtp.gmail.com';
	public $port = 465;

	public $user = 'test';
	public $pass = 'test';

	public $protocol = 'ssl';

	public function sendEmail($from, $to, $subject, $body, $attachments = array(), $host='smtp.gmail.com', $port = 465){
		
		$path = Yii::getPathOfAlias('ext.swiftmailer.lib');

		spl_autoload_unregister(array('YiiBase','autoload'));
		Yii::import('ext.swiftmailer.lib.swift_required', true);
		// require_once($path.DIRECTORY_SEPARATOR.'swift_required.php');
		spl_autoload_register(array('YiiBase','autoload'));

		$message = Swift_Message::newInstance()
			->setSubject($subject)
			->setFrom($this->user)
			->setTo($to)
			->setBody($body, 'text/html');

		if(!empty($attachments)){
			foreach ($attachments as $file) {
				$message->attach(Swift_Attachment::fromPath($file));
			}
		}

		$transport = Swift_SmtpTransport::newInstance($this->host, $this->port, $this->protocol)
			->setUsername($this->user)
			->setPassword($this->pass);

		$mailer = Swift_Mailer::newInstance($transport);
    	$result = $mailer->send($message);

		return $result;
	}
}