<?php

session_start();

require_once( 'FacebookAuth.php' );
 
$test = new FacebookAuth();

$url = $test->initFB();
$userInfo = $test->getUserInfo();

// show login/logout url
if($url['type'] === 'logout'){

  echo '<a href="' . $url['value'] . '">Logout</a>';

}else{

  echo '<a href="' . $url['value'] . '">Login</a>';
  
}
echo '<pre>';
print_r($userInfo);
echo '</pre>';
//print_r($test->registeruser());