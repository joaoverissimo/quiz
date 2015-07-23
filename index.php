<?php
require_once 'jquerycms/config.php';

$objQuiz = objEquiz::init(5);

if (count($_POST) > 0) {
    //print_r($_POST);
    $arrResultados = array();

    foreach ($_POST['pergunta'] as $pergunta => $alternativa) {
        $objPergunta = objEpergunta::init($pergunta);
        $objAlternativa = objEalternativa::init($alternativa);

        echo $objPergunta->getCod() . " - " . $objPergunta->getDescricao() . " === " . $objAlternativa->objResultado()->getCod() . " - " . $objAlternativa->objResultado()->getDescricao() . "\n\n";
        if (isset($arrResultados[$objAlternativa->objResultado()->getCod()])) {
            $arrResultados[$objAlternativa->objResultado()->getCod()] += 1;
        } else {
            $arrResultados[$objAlternativa->objResultado()->getCod()] = 1;
        }
    }
    print_r($arrResultados);

    die();
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

                <h1 style="font-size: 2.1em;">Quiz: <?php echo $objQuiz->getTitulo(); ?></h1>



                <form id="cadastro" method="post" action="/resultado.php">
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <?php foreach ($objQuiz->obtemEperguntaRel() as $key => $objPergunta) : ?>
                                    <li class="tab col">
                                        <a href="#equiz_aba_pergunta_<?php echo $key; ?>">
                                            <?php echo $key + 1; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <?php foreach ($objQuiz->obtemEperguntaRel() as $key => $objPergunta) : ?>
                            <div id="equiz_aba_pergunta_<?php echo $key; ?>" class="col s12 equiz-aba-pergunta">
                                <div class="card-panel">
                                    <h2 style="font-size: 1.7em;"><?php echo $objPergunta->getDescricao(); ?></h2>

                                    <?php if ($objPergunta->getImagem() !== null && $objPergunta->objImagem()->getExiste()) : ?>
                                        <div class="">
                                            <img class="responsive-img" src="<?php echo $objPergunta->objImagem()->getSrc_PropMax(400, 300); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <?php foreach ($objPergunta->obtemEalternativaRel() as $objAlternativa) : ?>
                                        <p>
                                            <input class="with-gap pergunta-<?php echo $objPergunta->getCod(); ?>" 
                                                   id="alternativa_<?php echo $objAlternativa->getCod(); ?>"
                                                   name="pergunta[<?php echo $objPergunta->getCod(); ?>]" 
                                                   type="radio" 
                                                   value="<?php echo$objAlternativa->getCod(); ?>" />

                                            <label for="alternativa_<?php echo $objAlternativa->getCod(); ?>">
                                                <?php echo $objAlternativa->getDescricao(); ?>
                                            </label>
                                        </p>
                                    <?php endforeach; ?>


                                    <?php if (($key + 1) == count($objQuiz->obtemEperguntaRel())) : ?>
                                        <button class="waves-effect waves-light btn light-green darken-3" id="btn-enviar">
                                            <i class="material-icons left">done</i> 
                                            Ver resultado
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>

                <div class="progress ">
                    <div class="determinate light-green darken-3" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <?php include 'masterpage/footer.php'; ?>
        <script>
            var obterPerguntas = function () {
                var groups = [];
                $("#cadastro :radio").each(function () {
                    if (groups.indexOf(this.name) < 0) {
                        groups.push(this.name);
                    }
                });

                return groups;
            };

            var obterAbaInvalida = function () {
                var div_id;
                $(".equiz-aba-pergunta").each(function () {
                    var checked = $(this).find(":radio:checked").length;
                    if (checked === 0 && !div_id) {
                        div_id = $(this).attr("id");
                        return true;
                    }
                });

                return div_id;
            };

            var obterPorcentagem = function () {
                var nuChecked = $("#cadastro :radio:checked").length;
                var nuGroups = obterPerguntas().length;
                var porcentagem = nuChecked / nuGroups * 100;

                $(".progress .determinate").width(porcentagem.toFixed(0) + '%');
                return porcentagem.toFixed(0);
            };

            var checarRespostas = function () {
                var checked = $("#cadastro :radio:checked");
                var groups = obterPerguntas();

                if (groups.length !== checked.length) {
                    var total = groups.length - checked.length;
                    var a = total > 1 ? ' perguntas ' : ' pergunta ';
                    var div_id = obterAbaInvalida();

                    alert(total + a + 'sem resposta');
                    $('ul.tabs').tabs('select_tab', div_id);

                    return false;
                }

                return true;
            };



            $(document).ready(function () {
                $("input:radio").click(function () {
                    obterPorcentagem();
                });

                $("#btn-enviar").click(function () {
                    if (!checarRespostas()) {
                        return false;
                    }
                });

<?php foreach ($objQuiz->obtemEperguntaRel() as $key => $objPergunta) : ?>
    <?php if (($key + 1) < count($objQuiz->obtemEperguntaRel())) : ?>
                        $(".pergunta-<?php echo $objPergunta->getCod(); ?>").click(function () {
                            $('ul.tabs').tabs('select_tab', 'equiz_aba_pergunta_<?php echo $key + 1; ?>');
                        });
    <?php else: ?>
                        //AQUYI
    <?php endif; ?>
<?php endforeach; ?>
            });
        </script>
    </body>
</html>