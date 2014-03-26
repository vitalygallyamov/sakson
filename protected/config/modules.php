<?php

$modules = array(
	// uncomment the following to enable the Gii tool

	'gii'=>array(
		'class'=>'system.gii.GiiModule',
		'password'=>'qwe123',
		'ipFilters'=>array('127.0.0.1','::1'),
		'generatorPaths'=>array(
		    'application.gii',
		),
		//'import' => array(
		//	'appext.imagesgallery.GalleryBehavior',
		//),
	),
	'admin'=>array(),
	'email'=>array(),
	'auth'=>array(
		// 'defaultLayout' => 'admin.views.layouts.main'
		// 'viewDir' => '/home/vetal/web_projects/sakson/protected/modules/admin/views'
	),
	'user'=>array(
		'hash' => 'md5',
		'sendActivationMail' => true,
		'loginNotActiv' => false,
		'activeAfterRegister' => false,
		'autoLogin' => true,
		'registrationUrl' => array('/user/registration'),
		'recoveryUrl' => array('/user/recovery'),
		'loginUrl' => array('/user/login'),
		'returnUrl' => array('/user/profile'),
		'returnLogoutUrl' => array('/user/login'),
	),
);