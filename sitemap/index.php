<?php
ini_set("memory_limit", "160M");
ini_set('max_execution_time', 30000);

require_once '../jquerycms/config.php';

$dados = dbEquiz::ObjsList($Conexao, new dataFilter(dbEquiz::_flaprovado, true));

header("Content-Type:text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
    <?php
    if ($dados) :
        foreach ($dados as $objQuiz) :
            ?>

            <url>
                <loc><?php echo $objQuiz->getRewriteUrl(true); ?></loc>
                <lastmod><?php echo date('c', time()); ?></lastmod>
                <priority>0.9</priority>
            </url>

            <?php
        endforeach;
    endif;
    ?>

</urlset>