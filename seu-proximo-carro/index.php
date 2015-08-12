<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once '../jquerycms/config.php';
require_once "../lib/Facebook/autoload.php";
require_once '../lib/SimpleImage-master/src/abeautifulsite/SimpleImage.php';

define('APP_ID', '1614001052210913');
define('APP_SECRET', 'b22d333dfc3e13ca8d641992234be92e');

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

if (isset($accessToken)) {
    $_SESSION['fb_access_token'] = (string) $accessToken;
    try {

        $responseName = $fb->get('/me?fields=id,name,gender', $accessToken);
        $responsePicture = $fb->get('/me/picture?type=large&redirect=false', $accessToken);

        $userNodeName = $responseName->getGraphUser();
        $userNodePicture = $responsePicture->getGraphUser();

        $resultados = array(
            array('nome' => 'Fiat Palio', 'imagem' => 'img/palio.jpg'),
            array('nome' => 'Chevrolet Onix', 'imagem' => 'img/onix.jpg'),
            array('nome' => 'Hyundai HB20', 'imagem' => 'img/hb20.jpg')
        );

        $nuAleatorio = rand(0, 2);
        $resultado = $resultados[$nuAleatorio];

        $usuario = array(
            'id' => $userNodeName['id'],
            'nome' => $userNodeName['name'],
            'foto' => $userNodePicture->getProperty('url')
        );
        $img = new abeautifulsite\SimpleImage('img/fundo.jpg');
        $img->best_fit(800, 420);

        $img->text('O próximo carro de', 'Roboto-Medium.ttf', 36, '#000000', 'top', 0, 10);
        $img->text('O próximo carro de', 'Roboto-Medium.ttf', 36, '#FFFFFF', 'top', -2, 8);

        //Desenha o usuario
        $usuarioImg = new abeautifulsite\SimpleImage($usuario['foto']);
        $usuarioImg->thumbnail(200, 180);

        $img->overlay($usuarioImg, 'top left', 1, 15, 120);

        $img->text($usuario['nome'], 'Roboto-Medium.ttf', 20, '#000000', 'top left', 17, 92);
        $img->text($usuario['nome'], 'Roboto-Medium.ttf', 20, '#FFFFFF', 'top left', 15, 90);

        //Desenha o carro
        $carro = new abeautifulsite\SimpleImage($resultado['imagem']);
        $carro->thumbnail(200, 180);

        $img->overlay($carro, 'bottom right', 1, -30, -30);

        $img->text($resultado['nome'], 'Roboto-Medium.ttf', 20, '#000000', 'bottom', 188, -238);
        $img->text($resultado['nome'], 'Roboto-Medium.ttf', 20, '#FFFFFF', 'bottom', 190, -240);

        $carroRendereziado = "output/face-test-{$usuario['id']}.jpg";
        $img->save($carroRendereziado);

        include './inc-resultado.php';
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
} else {
    $helper = $fb->getRedirectLoginHelper();
    $redirect_url = ___siteUrl . 'seu-proximo-carro/index.php';
    $loginUrl = $helper->getLoginUrl($redirect_url);
    include './inc-default.php';
}