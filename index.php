<?php

	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

	session_start();
	
	require 'config/Connection.php';    
	require 'class/Router.php';    
    require 'class/Input.php';
	
	$router = new Router;
	$input = new Input;
	$page = 'home';
	       
	if (null !== ($input->get('page'))){
		$page = $input->get('page');
	}
	
	$controller = $router->getController($page);
	$controllerFile = 'controller/' . $controller . 'Controller.php';
	
	include $controllerFile ;


	
/** ADMIN **/
