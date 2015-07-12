<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objJqueryseorel($Conexao, true);
$registro->loadByCod($_GET["cod"]);

$ctrlSeo = new CtrlJquerySeo($Conexao, $registro->getSeo(), 'jqueryseoctrlSeo');


//POST
if (count($_POST) > 0) {
    try {
        
        $registro->setSeo($ctrlSeo->updateByPost());
        $registro->setPalavra(issetpostInteger('palavra'));
        
        
        $exec = $registro->Save();

        if ($exec && $adm_tema != 'branco') {
            header("Location: $cancelLink");
        } else {
            $msg = fEnd_MsgString("O registro foi salvo.$fEnd_closeTheIFrameImDone", 'success');
        }
    } catch (jquerycmsException $exc) {
        $msg = fEnd_MsgString("Ocorreram problemas ao inserir o registro.", 'error', $exc->getMessage());
    }
}

//FORM
$form = new autoform2();
$form->start("cadastro","","POST");
    
$form->insertHtml($ctrlSeo->getCtrl());
$form->selectDb(__('jqueryseorel.palavra'), 'palavra', $registro->getPalavra(), '', $Conexao, 'jqueryseopalavra', 'cod', 'palavra');

    
$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_jqueryseorel');?> - Editar</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>
        <?php echo $ctrlSeo->getHead(); ?>
        
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_jqueryseorel');?> <small>Editar</small></h3>
                </div>
                
                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>