<?php
require_once '../jquerycms/config.php';
require_once "../lib/Facebook/autoload.php";
require_once '../lib/SimpleImage-master/src/abeautifulsite/SimpleImage.php';
require_once './fb_access_token.php';

$pageLink = ___siteUrl . "seu-proximo-carro/face-test-{$_GET['id']}.html";
$faceLink = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($pageLink);

$redirecionarParaIndex = true;
if (isset($accessToken)) {
    $responseName = $fb->get('/me?fields=id,name,gender', $accessToken);
    $userNodeName = $responseName->getGraphUser();

    if ($userNodeName['id'] == $_GET['id']) {
        $redirecionarParaIndex = false;
    }
}
?><!DOCTYPE HTML>
<html>
    <head>
        <?php include '../masterpage/head.php'; ?>
        <title>Descubra seu próximo carro</title>
        <link rel='canonical' href='<?php echo ___siteUrl . "seu-proximo-carro/index.php"; ?>'/>

        <meta property="og:title" content="Descubra qual o seu próximo carro." />
        <meta property="og:description" content="Saiba agora mesmo qual o seu próximo carro."/>
        <meta property="og:image" content="<?php echo ___siteUrl . "/seu-proximo-carro/output/face-test-{$_GET['id']}.jpg"; ?>" />
        <meta property="og:url" content="<?php echo $pageLink; ?>" />
        <meta property="og:type" content="website"/>
        <meta property="fb:app_id" content="<?php echo APP_ID; ?>"/>
        <meta property="og:image:width" content="800"/>
        <meta property="og:image:height" content="420"/>
        <meta property="og:image:type" content="image/jpeg"/>
        <meta property="og:site_name" content="facetest.com.br"/>

        <script>
            $(document).ready(function () {
                $('.my-facebook-share-button').on('click', function () {
                    window.newwindow = window.open('<?php echo $faceLink; ?>', 'facebook-share-dialog', 'width=572,height=567');
                    var winTimer = window.setInterval(function () {
                        if (window.newwindow.closed !== false) {
                            window.clearInterval(winTimer);
                            window.location.href = appConfig.forward_link;
                        }
                    }, 200);
                });

                $('.share_in_tw_click').on('click', function () {
                    window.open('http://twitter.com/share?url=' + encodeURIComponent($(this).data('sharelink')), 'twitter-share-dialog', 'width=572,height=467');
                });

            });
        </script>

        <?php if ($redirecionarParaIndex) : ?>
            <script>
                window.location.href = "/seu-proximo-carro/index.php";</script>
        <?php endif; ?>

    </head>
    <body>        
        <?php include '../masterpage/header.php'; ?>
        <h1 style="font-size: 2.1em;">E o seu próximo carro será....</h1>

        <div class="row">

            <div class="col s12">
                <div class="btn-share">
                    <a class="my-facebook-share-button" href="javascript:void(0);">
                        <img src="../masterpage/compartilhe.png"
                    </a>

                    <a class="waves-effect waves-light btn" href="index.php" style=" margin-top: -64px; padding-top: 4px; height: 41px; ">
                        <i class="material-icons right">replay</i> Jogar novamente
                    </a>
                </div>

                <div class="resultado-imagem">
                    <img class="my-facebook-share-button" src="<?php echo "/seu-proximo-carro/output/face-test-{$_GET['id']}.jpg?show=" . date('Y-m-d-h-i-s'); ?>" />
                </div>

                <div class="btn-share">
                    <a class="my-facebook-share-button" href="javascript:void(0);">
                        <img src="../masterpage/compartilhe.png"
                    </a>

                    <a class="waves-effect waves-light btn" href="index.php" style=" margin-top: -64px; padding-top: 4px; height: 41px; ">
                        <i class="material-icons right">replay</i> Jogar novamente
                    </a>
                </div>
            </div>
        </div>

        <?php include '../masterpage/footer.php'; ?>
    </body>
</html>