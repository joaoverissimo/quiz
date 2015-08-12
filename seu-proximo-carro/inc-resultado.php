<!DOCTYPE HTML>
<html>
    <head>
        <?php include '../masterpage/head.php'; ?>
        <title>Descubra seu próximo carro</title>
    </head>
    <body>        
        <?php include '../masterpage/header.php'; ?>
        <h1 style="font-size: 2.1em;">E o seu próximo carro será....</h1>

        <div class="row">

            <div class="col s12">
                <img src="<?php echo $carroRendereziado; ?>" />
            </div>
        </div>

        <?php include '../masterpage/footer.php'; ?>
    </body>
</html>