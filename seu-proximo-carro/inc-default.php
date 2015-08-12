<!DOCTYPE HTML>
<html>
    <head>
        <?php include '../masterpage/head.php'; ?>
    </head>
    <body>        
        <?php include '../masterpage/header.php'; ?>
        <h1 style="font-size: 2.1em;">Descubra qual o seu próximo carro</h1>

        <div class="row">

            <div class="col s12">
                <p>Faça login com o facebook para descobrir qual o seu próximo carro:</p>

                <a href="<?php echo $loginUrl; ?>">
                    <img src="http://www.adweek.com/socialtimes/wp-content/uploads/sites/2/2013/10/FBloginbutton.png" />
                </a>
            </div>
        </div>

        <?php include '../masterpage/footer.php'; ?>
    </body>
</html>