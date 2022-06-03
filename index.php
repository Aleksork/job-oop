<?php
error_reporting(-1);

session_start();


include 'config.php';
header("Content-Type:text/html;charset=utf8");

spl_autoload_register(function ($file) {
	if(file_exists('controller'.DIRECTORY_SEPARATOR.$file.'.php')) {
		require_once 'controller'.DIRECTORY_SEPARATOR.$file.'.php';
	}
	else {
		require_once 'model'.DIRECTORY_SEPARATOR.$file.'.php'; 
	}
});

if(isset($_GET['option'])) {
	$class = strip_tags($_GET['option']);
	
	switch($class) {
		case 'user':
		$init = new User();
		break;
		
		case 'admin':
		$init = new Admin();
		break;

		case 'supadmin':
		$init = new Supadmin();
		break;
		
		case 'create_worker-admin':
		$init = new CreateWorkerAdmin();
		break;

		case 'create_worker':
		$init = new CreateWorkerAdmin();
		break;

		case 'worker_job-admin':
		$init = new WorkerJobAdmin();
		break;

		case 'worker_job':
		$init = new WorkerJob();
		break;

		case 'edit_user-admin':
		$init = new EditUserAdmin();
		break;

		case 'edit_user':
		$init = new EditUser();
		break;

		case 'edit_inform-user':
		$init = new EditInformUser();
		break;

		case 'edit_work':
		$init = new EditWork();
		break;

		case 'edit_prem':
		$init = new EditPrem();
		break;
		
		case 'create_prem':
		$init = new CreatePrem();
		break;

		case 'login':
		$init = new Login();
		break;
		
		case 'create_work':
		$init = new CreateWork();
		break;

		case 'create_type-work':
		$init = new CreateTypeWork();
		break;

		case 'create_coof':
		$init = new CreateCoof();
		break;

		case 'sort_cash':
		$init = new SortCash();
		break;
		
		default :
		$init = new Login();
		break;
	}
}
else {
	$init = new Login();
}
echo $init->getBody();

if (!isset($_SESSION['msg'])) {
	$_SESSION['msg'] = NULL;
}

