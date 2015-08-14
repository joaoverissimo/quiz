<?php

ini_set('default_charset', 'UTF-8');
if (!isset($_SESSION)) {
    session_start();
}


define('APP_ID', '1614001052210913');
define('APP_SECRET', 'b22d333dfc3e13ca8d641992234be92e');

define('___MyDebugger', true);
define('___DataEHoraAtual', date('d/m/Y h:i:s'));
define('___DataAtual', date('d/m/Y'));
define('___AppRoot', obterDocumentRoot());
define('___cdn', 'https://github.com/joaoverissimo/jquery-cms-2/blob/master/_instalar/baseSistema.zip?raw=true');
define('___siteTitle', 'Jogo Quiz');

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == 'quiz.com.br') {
    define('___phpDataServer', 'localhost');
    define('___phpDataDb', 'quiz');
    define('___phpDataUser', 'root');
    define('___phpDataPass', '');
    define('___siteUrl', 'http://localhost/'); //sempre terminar com barra (.br/)
    define('___siteContactMail', 'contato@localhost.com.br');
    define('___SimpleCacheTime', 0);
} else {
    define('___phpDataServer', 'localhost');
    define('___phpDataDb', 'quiz');
    define('___phpDataUser', 'conweb');
    define('___phpDataPass', 'conweb2015');
    define('___siteUrl', 'http://facetest.com.br/');
    define('___siteContactMail', 'contato@localhost.com.br');
    define('___SimpleCacheTime', 3 * 60); //3 minutos para cache
}

$adm_folder = "/adm";
$loginURL = "$adm_folder/home/login.php";

require_once 'lib/sistema/BootStrapSistema.php';
require_once 'dataClass/bootStrapData.php';
require_once 'lib/autoform2/autoform2.php';
require_once 'dataObj/bootStrapObjFend.php';
if (arquivos::existe(___AppRoot . 'lib/bootstrap.php')) {
    require_once ___AppRoot . 'lib/bootstrap.php';
}

function obterDocumentRoot() {
    $AppRoot = $_SERVER['DOCUMENT_ROOT'];
    if ($AppRoot[strlen($AppRoot) - 1] != "/")
        $AppRoot.= "/";

    return $AppRoot;
}

function CarregarConexao() {
    $phpDataServer = ___phpDataServer;
    $phpDataDb = ___phpDataDb;
    $phpDataUser = ___phpDataUser;
    $phpDataPass = ___phpDataPass;
    $Conexao = new PDO("mysql:host=$phpDataServer; dbname=$phpDataDb", "$phpDataUser", "$phpDataPass", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return $Conexao;
}

$Conexao = CarregarConexao();

