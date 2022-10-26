<?php
session_start();
ini_set('display_errors', 1);
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;


$fb = new Facebook\Facebook([
	//'app_id' => '1842872169084290',
	//'app_secret' => '8078c67b4b7db19449b386fecd716b4b',
	'app_id' => '629058998373041', //epl1x2test
	'app_secret' => '793c89ea54d0488fdcdc6d1c3bdf4ea7', //epl1x2test
	'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // optional

//$loginUrl = $helper->getLoginUrl('https://www.epl1x2.com/login-callback.php', $permissions);
$loginUrl = $helper->getLoginUrl('http://localhost:8080/program_fb2022/login-callback.php', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>