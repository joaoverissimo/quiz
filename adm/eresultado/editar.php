<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objEresultado($Conexao, true);
$registro->loadByCod($_GET["cod"]);

$cancelLink = "index.php?quiz=" . $registro->getQuiz();
if ($adm_tema == "branco") {
    $cancelLink .= "&tema=branco";
}

//POST
if (count($_POST) > 0) {
    try {
        $registro->setDescricao(issetpost('descricao'));
        $registro->setTexto(issetpost('texto'));

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

        if ($exec) {
            header("Location: $cancelLink");
        }
    } catch (jquerycmsException $exc) {
        $msg = fEnd_MsgString("Ocorreram problemas ao inserir o registro.", 'error', $exc->getMessage());
    }
}

//FORM
$form = new autoform2();
$form->start("cadastro", "", "POST");

$form->text(__('eresultado.descricao'), 'descricao', $registro->getDescricao(), 1);
$form->textarea(__('eresultado.texto'), 'texto', $registro->getTexto(), 0);
$form->fileImagems(__('eresultado.imagem'), 'imagem', $registro->getImagem(), 0);

$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_eresultado'); ?> - Editar</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>

    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_eresultado'); ?> <small>Editar</small></h3>
                </div>

                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>