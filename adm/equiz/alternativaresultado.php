<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objEquiz($Conexao, true);
$registro->loadByCod($_GET["cod"]);

//POST
if (count($_POST) > 0) {
    try {

        if (issetArray($_POST['alternativa'])) {
            dbEalternativaresultado::DeletarWhere($Conexao, new dataFilter(dbEalternativaresultado::_quiz, $registro->getCod()));

            foreach ($_POST['alternativa'] as $alternativa => $resultado) {
                dbEalternativaresultado::Inserir($Conexao, $registro->getCod(), null, $alternativa, $resultado);
            }

            $msg = fEnd_MsgString("Operação realizada com sucesso.$fEnd_closeTheIFrameImDone", 'success');
        }
    } catch (jquerycmsException $exc) {
        $msg = fEnd_MsgString("Ocorreram problemas ao inserir o registro.", 'error', $exc->getMessage());
    }
}

$dbResultados = dbEresultado::ObjsList($Conexao, new dataFilter(dbEresultado::_quiz, $registro->getCod()));
$where = new dataFilter(dbEalternativaresultado::_quiz, $registro->getCod());
$dbAlternativaResultado = dbEalternativaresultado::ObjsList($Conexao, $where);
/*echo $where->SqlSimple();
print_r($dbAlternativaResultado);
die();*/
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_equiz'); ?> - Alternativa x Resultado</title>
        <?php include '../lib/masterpage/head.php'; ?>
        <script type='text/javascript' src='/jquerycms/js/jquery.validate.min.js'></script>
        <link rel='stylesheet' type='text/css' href='/jquerycms/js/autoform.css' />

        <script>

            $(document).ready(function () {
                $("#cadastro").validate({
                    highlight: function (label) {
                        $(label).siblings('.help-inline').removeClass('help-inline').addClass('help-block');
                        $(label).closest('.control-group').addClass('error');
                    },
                    success: function (label) {
                        label.closest('.control-group').removeClass('error');
                    }
                });
            });

            //seleciona as opcoes de alternativa resultado
            $(document).ready(function () {
<?php
if (issetArray($dbAlternativaResultado)) {
    foreach ($dbAlternativaResultado as $objAlternativaResultado) {
        ?>
                        $("#selAlternativa<?php echo $objAlternativaResultado->getAlternativa(); ?>").val(<?php echo $objAlternativaResultado->getResultado(); ?>);
        <?php
    }
}
?>
            });




        </script>
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_equiz'); ?> <small>Alternativa x Resultado</small></h3>
                </div>

                <?php echo $msg; ?>
                <form name='cadastro' id='cadastro' method='POST' class='form-horizontal' enctype='multipart/form-data'  >

                    <fieldset>
                        <legend>Perguntas</legend>
                        <?php if (issetArray($registro->obtemEperguntaRel())) : ?>
                            <ol>
                                <?php foreach ($registro->obtemEperguntaRel() as $objPergunta) : ?>
                                    <li style="padding: 10px; border: 1px solid #e5e5e5; background: #f5f5f5; margin: 5px;">
                                        <?php echo $objPergunta->getDescricao(); ?>

                                        <ul class="control-group"> 
                                            <?php if (issetArray($objPergunta->obtemEalternativaRel())) : ?>
                                                <?php foreach ($objPergunta->obtemEalternativaRel() as $objAlternativa) : ?>
                                                    <li class="controls">

                                                        <?php echo $objAlternativa->getDescricao(); ?>

                                                        <select id="selAlternativa<?php echo $objAlternativa->getCod(); ?>" name="alternativa[<?php echo $objAlternativa->getCod(); ?>]" class="required">
                                                            <option value=''>--Selecione--</option>

                                                            <?php
                                                            if (issetArray($dbResultados)) {
                                                                foreach ($dbResultados as $objResultado) {
                                                                    echo "<option value='{$objResultado->getCod()}'>{$objResultado->getDescricao()}</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                Não existem alternativas
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        <?php else : ?>
                            Não existem perguntas
                        <?php endif; ?>
                    </fieldset>

                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary '  >Salvar</button>
                    </div><div style='clear: both'></div>
                </form>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>