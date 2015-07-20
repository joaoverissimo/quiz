<?php
//REQUIRE E CONEXÃO
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';
$msg = "";

//Filtra a lista
$filtraList = "";
if (isset($_GET['filtraList']) && $_GET['filtraList']) {
    $filtraList = $_GET['filtraList'];
}

$quiz = "";
if (isset($_GET['quiz']) && $_GET['quiz']) {
    $quiz = $_GET['quiz'];
}

//Lista os dados
$where = new dataFilter(dbEresultado::_cod, 0, dataFilter::op_different);
if ($filtraList) {
    $where->add(dbEresultado::_descricao, $filtraList, dataFilter::op_likeMatches);
}

if ($quiz) {
    $where->add(dbEresultado::_quiz, $quiz);
}


$orderBy = new dataOrder('eresultado.cod');

$paginaAtual = 0;
if (isset($_REQUEST['page']))
    $paginaAtual = $_REQUEST['page'];

$pager = new dataPager($paginaAtual, 15, $Conexao, 'eresultado', $where);

$dados = dbEresultado::ObjsListLeft($Conexao, $where, $orderBy, $pager->getLimit());

$form = new autoform2();
$form->start("cadastro", "", "GET", array('class' => 'form-inline pull-right'));
$form->text("Busca rapida", "filtraList", $filtraList);
$form->selectDb(__('eresultado.quiz'), 'quiz', $quiz, 0, $Conexao, 'equiz', 'cod', 'titulo', '', '', 'Indiferente');
$form->send_cancel("Filtrar", "index.php", array('btn2class' => 'btn-mini'), "Limpar Filtros");
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_eresultado'); ?> - Listar</title>
        <link rel='stylesheet' type='text/css' href='/jquerycms/js/autoform.css' />

        <?php include '../lib/masterpage/head.php'; ?>
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo $quiz ? objEquiz::init($quiz)->getTitulo() . " - " : ""; ?><?php echo __('table_eresultado'); ?> <small>Listar</small></h3>
                </div>

                <div class="btn-toolbar">
                    <a href="inserir.php<?php echo $quiz ? "?quiz=$quiz" : ''; ?><?php echo $adm_tema == "branco" ? "&tema=branco" : ""; ?>" class="btn btn-primary"><i class="icon-plus icon-white"></i> Inserir</a>

                    <?php echo $form->getForm(); ?>
                </div>

                <?php if ($dados !== false) : ?>
                    <form method="post" action="deletar-multi.php">
                        <table class="table table-hover table-striped" id="tablelista">
                            <thead>
                                <tr>
                                    <th class="th-multi"></th>
                                    <th>Resultado</th> 
                                    <th><?php echo __('eresultado.texto'); ?></th> 
                                    <th><?php echo __('eresultado.imagem'); ?></th> 

                                    <th class="th-actions"></th>
                                </tr>
                            </thead>
                            <?php foreach ($dados as $registro) : ?>
                                <tr>
                                    <td><label><input type="checkbox" name="multi[]" value="<?php echo $registro->getCod(); ?>" class="multi-input" /></td>
                                    <td><?php echo $registro->getDescricao(); ?></td>
                                    <td><?php echo $registro->getTexto(); ?></td>
                                    <td><?php
                                        if ($registro->objImagem()->getExiste()) {
                                            echo "<img src='{$registro->objImagem()->getSrc(70, 35)}' />";
                                        }
                                        ?></td>

                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="editar.php?cod=<?php echo $registro->getCod(); ?><?php echo $adm_tema == "branco" ? "&tema=branco" : ""; ?>"><i class="icon-pencil icon-white"></i> <?php echo __('editar'); ?></a>
                                            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="deletar.php?cod=<?php echo $registro->getCod(); ?><?php echo $adm_tema == "branco" ? "&tema=branco" : ""; ?>"><i class="icon-trash"></i> <?php echo __('deletar'); ?></a></li>
                                            </ul>
                                        </div>  
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <div class="multi-actions">
                            <label class="muted"><input type="checkbox" id="multi_all" /> Marcar/Desmarcar</label>
                            <button type="submit" class="btn btn-mini" id="multi_submit">Deletar Selecionados</button>
                        </div>
                    </form>
                <?php else : ?>
                    Não existem registros.
                <?php endif; ?>

                <?php echo $pager->getPager(); ?>

            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>
