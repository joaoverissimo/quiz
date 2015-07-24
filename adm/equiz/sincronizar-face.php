<?php
//REQUIRE E CONEXÃO
require_once '../../jquerycms/config.php';
require_once '../lib/admin.php';

$where = new dataFilter(dbEquiz::_flaprovado, true);

$paginaAtual = 0;
if (isset($_REQUEST['page'])) {
    $paginaAtual = $_REQUEST['page'];
}

$pager = new dataPager($paginaAtual, 1, $Conexao, 'equiz', $where);
$dados = dbEquiz::ObjsListLeft($Conexao, $where, "", $pager->getLimit());

$objQuiz = $dados[0];

echo "Aguarde obtendo {$objQuiz->getCod()} - {$objQuiz->getTitulo()}... <br />";
echo "Página: $paginaAtual de " . ($pager->getTotalPages() - 1) . "<br />";


$faceRest = arquivos::lerUrl("http://api.facebook.com/restserver.php?method=links.getStats&urls=" . $objQuiz->getRewriteUrl(true));
$faceXml = simplexml_load_string($faceRest);
$faceArr = json_decode(json_encode((array) $faceXml), true);

if (isset($faceArr["link_stat"]["total_count"])) {
    $votos = $faceArr["link_stat"]["total_count"];
    $objQuiz->setVotos($votos);
    $objQuiz->Save();
    echo "Facebook: $votos voto(s). <br />";
} else {
    echo "Facebook: problemas ao obter. $faceRest";
}


if ($paginaAtual == ($pager->getTotalPages() - 1)) {
    die("acabou.");
} else {
    ?>
    <a href="<?php echo $pager->getLinkPage($paginaAtual + 1); ?>">próxima</a>
    <script>
        window.location.href = "<?php echo $pager->getLinkPage($paginaAtual + 1); ?>";
    </script>
<?php } ?>