<?php
require_once 'jquerycms/config.php';

$objQuiz = objEquiz::init(5);

if (count($_POST) > 0) {
    //print_r($_POST);
    $arrResultados = array();

    foreach ($_POST['pergunta'] as $pergunta => $alternativa) {
        $objPergunta = objEpergunta::init($pergunta);
        $objAlternativa = objEalternativa::init($alternativa);

        //echo $objPergunta->getCod() . " - " . $objPergunta->getDescricao() . " === " . $objAlternativa->objResultado()->getCod() . " - " . $objAlternativa->objResultado()->getDescricao() . "\n\n";
        if (isset($arrResultados[$objAlternativa->objResultado()->getCod()])) {
            $arrResultados[$objAlternativa->objResultado()->getCod()] += 1;
        } else {
            $arrResultados[$objAlternativa->objResultado()->getCod()] = 1;
        }
    }

    //Retorna a maior
    $resultado = array_search(max($arrResultados), $arrResultados);
    $objResultado = objEresultado::init($resultado);
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php echo $objQuiz->objSeo()->getHeadTags("Quiz: " . $objQuiz->getTitulo()); ?>
        <?php include 'masterpage/head.php'; ?>
    </head>
    <body>        
        <?php include 'masterpage/header.php'; ?>

        <div class="container">
            <div class="">
                <h1 style="font-size: 2.1em;">Resultado: <?php echo $objQuiz->getTitulo(); ?></h1>

                <div class="row">

                    <div class="col s12 equiz-aba-resultado">
                        <div class="card-panel">
                            <h2 style="font-size: 1.7em;"><?php echo $objResultado->getDescricao(); ?></h2>

                            <?php if ($objResultado->getImagem() !== null && $objResultado->objImagem()->getExiste()) : ?>
                                <div class="">
                                    <img class="responsive-img" src="<?php echo $objResultado->objImagem()->getSrc_PropMax(400, 300); ?>">
                                </div>
                            <?php endif; ?>

                            <p>
                                <?php echo $objResultado->getTexto(); ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'masterpage/footer.php'; ?>
    </body>
</html>