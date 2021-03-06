<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objEalternativa($Conexao, true);
$registro->loadByCod($_GET["cod"]);

//POST
if (count($_POST) > 0) {
    try {
        $registro->setDescricao(issetpost('descricao'));
        $registro->setImagem(dbJqueryimage::UpdateByFileImagems($Conexao, 'imagem'));

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
$form->start("cadastro", "", "POST");

$form->text(__('ealternativa.descricao'), 'descricao', $registro->getDescricao(), 1);
$form->fileImagems(__('ealternativa.imagem'), 'imagem', $registro->getImagem(), 0);

$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_ealternativa'); ?> - Editar</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>

    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_ealternativa'); ?> <small>Editar</small></h3>
                </div>

                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>