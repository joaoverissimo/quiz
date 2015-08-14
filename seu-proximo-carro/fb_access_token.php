<?php

$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.4'
        ]);

if (isset($_SESSION['fb_access_token'])) {
    $accessToken = $_SESSION['fb_access_token'];

    // verifica validade e expiracao do token
    $oAuth2Client = $fb->getOAuth2Client();
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);

    // valida token
    try {
        $tokenMetadata->validateAppId(APP_ID);
        $tokenMetadata->validateExpiration();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        unset($accessToken);
        unset($_SESSION['fb_access_token']);
    }
} else {

    $helper = $fb->getRedirectLoginHelper();
    try {
        $accessToken = $helper->getAccessToken();
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}