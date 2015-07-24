<?php
//REQUIRE E CONEXÃO
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';
$msg = "";

$registro = new objEquiz($Conexao);
$registro->setFlaprovado(true);

$ctrlSeo = new CtrlJquerySeo($Conexao, 0, 'jqueryseoctrlSeo');


//POST
if (count($_POST) > 0) {
    try {
        $registro->setUsuario($currentUser->getCod());

        $ctrlSeo->keyTitle = issetpost('titulo');
        $registro->setSeo($ctrlSeo->inserirByPost());

        $registro->setTitulo(issetpost('titulo'));
        $registro->setData(___DataEHoraAtual);
        $registro->setFlaprovado(issetpostInteger('flaprovado'));
        $registro->setVotos(0);

        if (isset($_FILES['imagem-file']) && $_FILES['imagem-file']["size"] > 0) {
            //Se possui imagem chama funcao de insercao de imagem
            $registro->setImagem(dbJqueryimage::InserirByFileImagems($Conexao, 'imagem'));
        } else {
            $registro->setImagem(null);
        }

        $exec = $registro->Save();

        if ($exec && $adm_tema != 'branco') {
            header("Location: editar.php?cod={$registro->getCod()}");
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

$form->text(__('equiz.titulo'), 'titulo', $registro->getTitulo(), 1);
$form->fileImagems(__('equiz.imagem'), 'imagem', $registro->getImagem(), 0);
$form->insertHtml($ctrlSeo->getCtrl());
$form->checkbox(__('equiz.flaprovado'), 'flaprovado', $registro->getFlaprovado(), 0);


$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_equiz'); ?> - Inserir</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>
        <?php echo $ctrlSeo->getHead(); ?>

    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_equiz'); ?> <small>Inserir</small></h3>
                </div>

                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>