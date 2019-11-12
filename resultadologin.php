<?php

require_once 'Facebook\autoload.php';
Session_start();
$fb = new Facebook\Facebook([
    'app_id' => '555520875021408', // Replace {app-id} with your app id
    'app_secret' => 'ec1bfd77d6326bf25fbaf0a856dcc4d2',
    'default_graph_version' => 'v3.2',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();

    $reponse = $fb->get('/me?access_token=' . $accessToken . '&locale=en_US&fields=email');
    $userNode = $reponse->getGraphUser();

    echo $userNode['email'];
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
