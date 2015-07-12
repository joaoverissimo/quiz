<?php
//REQUIRE E CONEXÃO
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';
$msg = "";

$registro = new objNoticia($Conexao);
$ctrl = new CtrlJquerySeo($Conexao);
//POST
if (count($_POST) > 0) {
    $registro->setTitulo(issetpost('titulo'));

    try {
        $ctrl->keyTitle = issetpost('titulo');
        $registro->setSeo($ctrl->inserirByPost());
        $exec = $registro->Save();

        if ($exec && $adm_tema != 'branco') {
            header("Location: index.php");
        } else {
            $msg = fEnd_MsgString("O registro foi inserido.$fEnd_closeTheIFrameImDone", 'success');
        }
    } catch (jquerycmsException $exc) {
        $msg = fEnd_MsgString("Ocorreram problemas ao inserir o registro.", 'error', $exc->getMessage());
    }
}


//FORM
$form = new autoform2();
$form->start("cadastro", "", "POST");

$form->text(__('noticia.titulo'), 'titulo', $registro->getTitulo(), 1);
$form->insertHtml($ctrl->getCtrl());

$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_noticia'); ?> - Inserir</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>
        <?php echo $ctrl->getHead(); ?>
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_noticia'); ?> <small>Inserir</small></h3>
                </div>

                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>

            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>