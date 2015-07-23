<?php
//REQUIRE E CONEXÃO
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';
$msg = "";

$registro = new objEalternativa($Conexao);

if (isset($_GET['pergunta'])) {
    $registro->setPergunta($_GET['pergunta']);
    $quiz = $registro->objPergunta()->getQuiz();
    $registro->setQuiz($quiz);
}

//POST
if (count($_POST) > 0) {
    try {
        $registro->setQuiz(issetpostInteger('quiz'));
        $registro->setPergunta(issetpostInteger('pergunta'));
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
        } elseif (isset($_POST['acao']) && $_POST['acao'] == "on") {
            header("Location: inserir.php?pergunta={$_GET['pergunta']}&tema=branco");
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

if (isset($_GET['pergunta'])) {
    $form->hidden('pergunta', $registro->getPergunta());
    $form->hidden('quiz', $registro->getQuiz());
} else {
    $form->selectDb(__('ealternativa.quiz'), 'quiz', $registro->getQuiz(), '1', $Conexao, 'equiz', 'cod', 'titulo');
    $form->selectDb(__('ealternativa.pergunta'), 'pergunta', $registro->getPergunta(), '1', $Conexao, 'epergunta', 'cod', 'descricao');
}

$form->text(__('ealternativa.descricao'), 'descricao', $registro->getDescricao(), 1);
$form->fileImagems(__('ealternativa.imagem'), 'imagem', $registro->getImagem(), 0);

$form->checkbox("Salvar e inserir outra", "acao", 1);

$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_ealternativa'); ?> - Inserir</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>

    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_ealternativa'); ?> <small>Inserir</small></h3>
                </div>
                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>