<?php
require_once './jquerycms/config.php';
require_once './lib/Facebook/autoload.php';

$fb = new Facebook\Facebook(array(
    'app_id' => '804147886366336',
    'app_secret' => '28e3b5eb80ebfd8b3d224e1d2707c632',
    'default_graph_version' => 'v2.2',
        )
);


$helper = $fb->getRedirectLoginHelper();
$permissions = array('email', 'user_likes'); // optional
$loginUrl = $helper->getLoginUrl('http://quiz.com.br/face.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
$accessToken = $helper->getAccessToken();

if ($accessToken) {
    $fb->setDefaultAccessToken($accessToken->getValue());

    $response = $fb->get('/me');
    $userNode = $response->getGraphUser();
    ?>
    <h3> Welcome <?php echo $userNode->getName(); ?> !!! </h3>
    <img src="https://graph.facebook.com/<?php echo $userNode->getId(); ?>/picture">
    <img src="https://graph.facebook.com/<?php echo $userNode->getId(); ?>/picture?type=large">
    <?php
}