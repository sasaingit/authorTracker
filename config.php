<?php
ini_set('error_log' , '/tmp/authtraker.log');

$conf = array();
$conf['appId'] 			= '652791944863205';
define("__APP_ID__", 652791944863205);
$conf['appSecret'] 		= '4bf90349417012b420c553a433a9a338';
$conf['fb_permission'] 	= 'public_profile,email';

$conf['db_host'] 		= 'localhost';
$conf['db_uname'] 		= 'root';
$conf['db_pwd'] 		= '1234';
$conf['db_database'] 	= 'authorTracker';

$conf['action_url'] 	= 'actions.php';


?>