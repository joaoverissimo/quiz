<?php
require_once 'jquerycms/config.php';


//Lista os dados
$where = new dataFilter(dbEquiz::_flaprovado, true);
$orderBy = new dataOrder(dbEquiz::_votos, 'desc');

$paginaAtual = 0;
if (isset($_REQUEST['page'])) {
    $paginaAtual = $_REQUEST['page'];
}

$pager = new dataPager($paginaAtual, 30, $Conexao, 'equiz', $where);
$dados = dbEquiz::ObjsListLeft($Conexao, $where, $orderBy, $pager->getLimit());
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo ___siteTitle; ?></title>
        <?php include 'masterpage/head.php'; ?>
    </head>
    <body>        
        <?php include 'masterpage/header.php'; ?>

        <h1 style="font-size: 2.1em;"><?php echo ___siteTitle; ?></h1>

        <div class="row">
            <?php if ($dados) : ?>
                <?php foreach ($dados as $objQuiz) : ?>
                    <div class="col s12 m4">
                        <div class="card small hoverable">
                            <?php if ($objQuiz->getImagem() !== null && $objQuiz->objImagem()->getExiste()) : ?>
                                <h3 class="card-image" style="margin: 0; line-height: initial">
                                    <a href="<?php echo $objQuiz->getRewriteUrl(); ?>">
                                        <img src="<?php echo $objQuiz->objImagem()->getSrc(280, 160); ?>">
                                        <span class="card-title"><?php echo $objQuiz->getTitulo(); ?></span>
                                    </a>
                                </h3>
                                <div class="card-content">
                                    <p><?php echo $objQuiz->objSeo()->getDescricao(); ?></p>
                                </div>
                                <div class="card-action">
                                    <a href="<?php echo $objQuiz->getRewriteUrl(); ?>">Jogar Quiz</a>
                                </div>
                            <?php else : ?>
                                <div class="card-content">
                                    <h3 class="card-title" style="margin: 0; line-height: initial">
                                        <a class="grey-text text-darken-4"  href="<?php echo $objQuiz->getRewriteUrl(); ?>">
                                            <?php echo $objQuiz->getTitulo(); ?>
                                        </a>
                                    </h3>
                                    <p>
                                        <a href="<?php echo $objQuiz->getRewriteUrl(); ?>">
                                            <?php echo $objQuiz->objSeo()->getDescricao(); ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="card-action">
                                    <a href="<?php echo $objQuiz->getRewriteUrl(); ?>">Jogar Quiz</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                Não existem quiz liberados.
            <?php endif; ?>
        </div>

        <div class="row">
            <?php echo $pager->getPager(); ?>
        </div>

        <?php include 'masterpage/footer.php'; ?>
    </body>
</html>