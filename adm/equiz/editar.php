<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objEquiz($Conexao, true);
$registro->loadByCod($_GET["cod"]);

$ctrlSeo = new CtrlJquerySeo($Conexao, $registro->getSeo(), 'jqueryseoctrlSeo');


//POST
if (count($_POST) > 0) {
    try {
        $registro->setSeo($ctrlSeo->updateByPost());
        $registro->setTitulo(issetpost('titulo'));
        $registro->setFlaprovado(issetpostInteger('flaprovado'));

        if (isset($_FILES['imagem-file']) && $_FILES['imagem-file']["size"] > 0) {
            //Se possui imagem
            if ($registro->getImagem() === null) {
                // chama funcao de insercao de imagem
                $registro->setImagem(dbJqueryimage::InserirByFileImagems($Conexao, 'imagem'));
            } else {
                // chama funcao de edicao de imagem
                $registro->setImagem(dbJqueryimage::UpdateByFileImagems($Conexao, 'imagem'));
            }
        }

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

$form->text(__('equiz.titulo'), 'titulo', $registro->getTitulo(), 1);
$form->fileImagems(__('equiz.imagem'), 'imagem', $registro->getImagem(), 0);
$form->insertHtml($ctrlSeo->getCtrl());
$form->checkbox(__('equiz.flaprovado'), 'flaprovado', $registro->getFlaprovado(), 0);


$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_equiz'); ?> - Editar</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>
        <?php echo $ctrlSeo->getHead(); ?>

    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_equiz'); ?> <small>Editar</small></h3>
                </div>

                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>