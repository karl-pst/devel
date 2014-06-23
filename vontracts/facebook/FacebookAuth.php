<?php

define('REDIRECT_URL', 'http://vontracts.io/facebook/');
define('LOGOUT_URL', 'http://vontracts.io/facebook/logout.php');
define('APPID', '1437163739868341');
define('APPSECRET', '5988295d90e50b9b41975e972f6cd20f');

 
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/FacebookHttpable.php' );
require_once( 'Facebook/FacebookCurl.php' );
require_once( 'Facebook/FacebookCurlHttpClient.php' );
require_once( 'Facebook/GraphSessionInfo.php' );
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurl;
use Facebook\FacebookCurlHttpClient;
use Facebook\GraphSessionInfo;

Class FacebookAuth{

	private $fbObj;

	public function initFB(){

		// init app with app id (APPID) and secret (SECRET)
		FacebookSession::setDefaultApplication(APPID, APPSECRET);
		 
		// login helper with redirect_uri
		$helper = new FacebookRedirectLoginHelper( REDIRECT_URL );
		// see if a existing session exists
		if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
			// create new session from saved access_token
			$session = new FacebookSession( $_SESSION['fb_token'] );

			// validate the access_token to make sure it's still valid
			try {
			if ( !$session->validate() ) {
			  $session = null;
			}
			} catch ( Exception $e ) {
			// catch any exceptions
			$session = null;
			}
		  
		} else {
			// no session exists

			try {
			$session = $helper->getSessionFromRedirect();
			} catch( FacebookRequestException $ex ) {
			// When Facebook returns an error
			} catch( Exception $ex ) {
			// When validation fails or other local issues
			echo $ex->message;
			}
		  
		}
		 
		// see if we have a session
		if ( isset( $session ) ) {
		  
			// save the session
			$_SESSION['fb_token'] = $session->getToken();

			// create a session using saved token or the new one we generated at login
			$session = new FacebookSession( $session->getToken() );

			// graph api request for user data
			$request = new FacebookRequest( $session, 'GET', '/me' );
			$response = $request->execute();

			// get response
			$graphObject = $response->getGraphObject()->asArray();  

			//set user's info
			$this->fbObj = $graphObject;

			$this->url = array('value' => $helper->getLogoutUrl( $session, LOGOUT_URL ), 'type' => 'logout');

		  
		} else {
			$this->url = array('value' => $helper->getLoginUrl( array( 'email', 'public_profile' ) ), 'type' => 'login');
		}

		return $this->url;
	}


	public function getUserInfo(){
		//save user info to db here
		return $this->fbObj;
	}
}

