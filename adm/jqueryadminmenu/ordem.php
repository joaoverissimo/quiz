<?php
//REQUIRE E CONEXÃO
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';
$msg = "";

$codmenu = "";
if (isset($_GET['codmenu'])) {
    $codmenu = $_GET['codmenu'];
    //Lista os dados
    $where = new dataFilter(dbJqueryadminmenu::_codmenu, $codmenu);
    $where->add(dbJqueryadminmenu::_cod, 0, dataFilter::op_different);
    $dados = dbJqueryadminmenu::ObjsList($Conexao, $where, 'ordem asc');
} else {
    $dados = false;

    $form = new autoform2();
    $form->start("cadastro", "", "GET");
    $form->insertHtml(dbJqueryadminmenu::getAutoFormField("Menu para ordenar", "codmenu", "", 1, $Conexao));
    $form->send_cancel("Avançar", "index.php", "Cancelar");
    $form->end();
}
?><!DOCTYPE HTML>
<html>
    <head>
        <title>Ordem</title>

        <?php include '../lib/masterpage/head.php'; ?>

        <script type='text/javascript' src='/jquerycms/js/jquery-ui/js/jquery-ui-1.8.19.custom.min.js'></script>
        <link rel='stylesheet' href='/jquerycms/js/jquery-ui/css/ui-lightness/jquery-ui-1.8.19.custom.css' type='text/css' media='all' />
        <script>
            $(document).ready(function () {
                $('.ordem').sortable({
                    update : function () {
                        order = [];
                        $('.ordem').children('li').each(function(idx, elm) {
                            order.push(elm.id.split('_')[1]);
                        });

                        $('#status').load('ordem-salvar.php', {'order' : order});
                        $('#status').html('Aguarde...');
                    }
                });

                $('.ordem').disableSelection();
            });
        </script>
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3>Ordem</h3>
                </div>

                <div class="btn-toolbar">
                    <a href="index.php<?php echo $codmenu ? "?codmenu=$codmenu" : ""; ?>" class="btn btn-primary"><i class="icon-arrow-left icon-white"></i> Voltar</a>
                </div>

                <div id="status"></div>

                <?php if ($dados !== false) { ?>
                    <ul class="ordem">
                        <?php foreach ($dados as $obj) { ?>

                            <li class="navbar-inner" id="listItem_<?php echo $obj->getCod(); ?>">
                                <span class="titulo"><?php echo $obj->getTitulo(); ?></span>
                            </li>

                        <?php } ?>
                    </ul>
                    <?php
                } else {
                    echo $form->getHead();
                    echo $form->getForm();
                }
                ?>

            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>