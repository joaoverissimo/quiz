<?php
//REQUIRE E CONEXÃO
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';
$msg = "";

$registro = new objEpergunta($Conexao);

if (isset($_GET['quiz'])) {
    $registro->setQuiz($_GET['quiz']);
}

//POST
if (count($_POST) > 0) {
    try {
        $registro->setQuiz(issetpostInteger('quiz'));
        $registro->setDescricao(issetpost('descricao'));
        $registro->setOrdem(99);

        if (isset($_FILES['imagem-file']) && $_FILES['imagem-file']["size"] > 0) {
            //Se possui imagem chama funcao de insercao de imagem
            $registro->setImagem(dbJqueryimage::InserirByFileImagems($Conexao, 'imagem'));
        } else {
            $registro->setImagem(null);
        }

        $exec = $registro->Save();

        if ($exec && $adm_tema != 'branco') {
            header("Location: $cancelLink");
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

if (isset($_GET['quiz'])) {
    $form->hidden('quiz', $registro->getQuiz());
} else {
    $form->selectDb(__('epergunta.quiz'), 'quiz', $registro->getQuiz(), '1', $Conexao, 'equiz', 'cod', 'titulo');
}

$form->text(__('epergunta.descricao'), 'descricao', $registro->getDescricao(), 1);
$form->fileImagems(__('epergunta.imagem'), 'imagem', $registro->getImagem(), 0);

$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_epergunta'); ?> - Inserir</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>

    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_epergunta'); ?> <small>Inserir</small></h3>
                </div>

                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>