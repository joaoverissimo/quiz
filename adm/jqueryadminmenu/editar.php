<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objJqueryadminmenu($Conexao, true);
$registro->loadByCod($_GET["cod"]);

//POST
if (count($_POST) > 0) {
    $registro->setCodmenu(issetpostInteger('codmenu'));
    $registro->setTitulo(issetpost('titulo'));
    $registro->setPatch(issetpost('patch'));
    $registro->setAddhtml(issetpost('addhtml'));

    try {
        $registro->setIcon(dbJqueryimage::UpdateByFileImagems($Conexao, 'icon'));
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

$form->selectDb(__('jqueryadminmenu.codmenu'), 'codmenu', $registro->getCodmenu(), '', $Conexao, 'jqueryadminmenu', 'cod', 'titulo');
$form->text(__('jqueryadminmenu.titulo'), 'titulo', $registro->getTitulo(), 1);
$form->text(__('jqueryadminmenu.patch'), 'patch', $registro->getPatch(), 1);
$form->fileImagems(__('jqueryadminmenu.icon'), 'icon', $registro->getIcon(), 0);
$form->text(__('jqueryadminmenu.addhtml'), 'addhtml', $registro->getAddhtml(), 0);


$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_jqueryadminmenu'); ?> - Editar</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_jqueryadminmenu'); ?> <small>Editar</small></h3>
                </div>

                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>