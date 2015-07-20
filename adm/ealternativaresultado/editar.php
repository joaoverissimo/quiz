<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objEalternativaresultado($Conexao, true);
$registro->loadByCod($_GET["cod"]);



//POST
if (count($_POST) > 0) {
    try {
        $registro->setQuiz(issetpostInteger('quiz'));
        $registro->setPergunta(issetpostInteger('pergunta'));
        $registro->setAlternativa(issetpostInteger('alternativa'));
        $registro->setResultado(issetpostInteger('resultado'));
        
        
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
    
$form->selectDb(__('ealternativaresultado.quiz'), 'quiz', $registro->getQuiz(), '', $Conexao, 'equiz', 'cod', 'titulo');
$form->selectDb(__('ealternativaresultado.pergunta'), 'pergunta', $registro->getPergunta(), '', $Conexao, 'epergunta', 'cod', 'descricao');
$form->selectDb(__('ealternativaresultado.alternativa'), 'alternativa', $registro->getAlternativa(), '', $Conexao, 'ealternativa', 'cod', 'descricao');
$form->selectDb(__('ealternativaresultado.resultado'), 'resultado', $registro->getResultado(), '', $Conexao, 'eresultado', 'cod', 'descricao');

    
$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_ealternativaresultado');?> - Editar</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>
        
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_ealternativaresultado');?> <small>Editar</small></h3>
                </div>
                
                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>