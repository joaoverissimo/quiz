<?php
//REQUIRE e VALIDA PÁGINA
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$msg = "";
Fncs_ValidaQueryString("cod", "index.php");

//CONEXÃO E VALORES
$registro = new objLocmapaponto($Conexao, true);
$registro->loadByCod($_GET["cod"]);



//POST
if (count($_POST) > 0) {
    try {
        $registro->setLat(issetpost('lat'));
        $registro->setLng(issetpost('lng'));
        $registro->setHeading(issetpost('heading'));
        $registro->setPitch(issetpost('pitch'));
        $registro->setZoom(issetpost('zoom'));
        $registro->setComportamento(issetpostInteger('comportamento'));
        $registro->setSuportaview(issetpostInteger('suportaview'));
        
        
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
    
$form->text(__('locmapaponto.lat'), 'lat', $registro->getLat(), 1);
$form->text(__('locmapaponto.lng'), 'lng', $registro->getLng(), 1);
$form->text(__('locmapaponto.heading'), 'heading', $registro->getHeading(), 1);
$form->text(__('locmapaponto.pitch'), 'pitch', $registro->getPitch(), 1);
$form->text(__('locmapaponto.zoom'), 'zoom', $registro->getZoom(), 1);
$form->text(__('locmapaponto.comportamento'), 'comportamento', $registro->getComportamento(), 3);
$form->checkbox(__('locmapaponto.suportaview'), 'suportaview', $registro->getSuportaview(), 0);

    
$form->send_cancel("Salvar", $cancelLink);
$form->end();
?><!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo __('table_locmapaponto');?> - Editar</title>

        <?php include '../lib/masterpage/head.php'; ?>
        <?php echo $form->getHead(); ?>
        
    </head>
    <body>        
        <?php include '../lib/masterpage/header.php'; ?>

        <div class="main">
            <div class="inner">
                <div class="page-header">
                    <h3><?php echo __('table_locmapaponto');?> <small>Editar</small></h3>
                </div>
                
                <?php echo $msg; ?>
                <?php echo $form->getForm(); ?>
            </div>
        </div>
        <?php include '../lib/masterpage/footer.php'; ?>
    </body>
</html>