<?php

require_once '../jquerycms/config.php';
require_once "../lib/Facebook/autoload.php";
require_once '../lib/SimpleImage-master/src/abeautifulsite/SimpleImage.php';

require_once './fb_access_token.php';

if (isset($accessToken)) {
    $_SESSION['fb_access_token'] = (string) $accessToken;
    try {

        $responseName = $fb->get('/me?fields=id,name,gender', $accessToken);
        $responsePicture = $fb->get('/me/picture?type=large&redirect=false', $accessToken);

        $userNodeName = $responseName->getGraphUser();
        $userNodePicture = $responsePicture->getGraphUser();

        require_once './array.php';

        $nuAleatorio = rand(0, count($resultados) - 1);
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
        $carro->thumbnail(260, 180);

        $img->overlay($carro, 'bottom right', 1, -50, -30);

        $img->text($resultado['nome'], 'Roboto-Medium.ttf', 20, '#000000', 'bottom', 188, -238);
        $img->text($resultado['nome'], 'Roboto-Medium.ttf', 20, '#FFFFFF', 'bottom', 190, -240);

        $carroRendereziado = "output/face-test-{$usuario['id']}.jpg";
        $img->save($carroRendereziado);

        $_SESSION['seu-proximo-carro'] = array(
            'carroRendereziado' => $carroRendereziado,
        );

        header("Location: face-test-{$usuario['id']}.html");
        die();
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