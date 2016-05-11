<?php

date_default_timezone_set('UTC'); 

require('vendor/autoload.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequestException;
use Facebook\FacebookRequest;
use Facebook\HttpClients\FacebookGuzzleHttpClient;

// Set Facebook App ID, App Secret and Site URL
$_CONFIG = [
    'appid' => getenv('FB_APPID') ?: '',
    'secret' => getenv('FB_SECRET') ?: '',
    'site_url' => getenv('SITE_URL') ?: '',
    'access_token_key_prefix' => 'fbat_'
];

$access_token_key = $_CONFIG['access_token_key_prefix'] . $_CONFIG['appid'];

session_start();

// Setup application
FacebookSession::setDefaultApplication($_CONFIG['appid'], $_CONFIG['secret']);
FacebookRequest::setHttpClientHandler(new FacebookGuzzleHttpClient());

// Get the helper
$helper = new FacebookRedirectLoginHelper($_CONFIG['site_url']);

// Attempt to retrieve a session
if (isset($_GET['code'])) {
    $session = $helper->getSessionFromRedirect();

    if (!is_null($session)) {
        $_SESSION[$access_token_key] = $session->getToken();
    }

    header('Location: ' . $_CONFIG['site_url']);
}
if (isset($_SESSION[$access_token_key])) {
    $session = new FacebookSession($_SESSION[$access_token_key]);

    try {
        $session->validate();
    } catch (FacebookSDKException $e) {
        $session = null;
    }
}

if (is_null($session)) {
    header('Location:' . $helper->getLoginUrl(['publish_actions']));
    exit;
}

$user_profile = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject('Facebook\GraphUser')->asArray();

// Start the upload
if (isset($_POST['action']) && $_POST['action'] == "upload_fb_image") {
	$message = ($_POST['message'] == 'Add a description...') ? 'This photo was created with the Cool Frames application. You can purchase the App here: http://bit.ly/YRtEVy' : $_POST['message'];

	// The relative path to the file
	$file = realpath("fb_images/".$_POST['photo']);

	try {
        $response = (new FacebookRequest($session, 'POST', '/me/photos', [
            'source' => fopen($file, 'r'),
            'message' => $message
        ]))->execute();

        $success = 'true';
    } catch (FacebookRequestException $e) {
        $success = 'false';
    }

	header("Location: index.php?res=$success");
}
