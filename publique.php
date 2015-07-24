<?php
require_once 'jquerycms/config.php';
$msg = "";

if (count($_POST) > 0) {
    $email = $_POST['publique']['email'];
    $perguntas = $_POST['publique']['perguntas'];
    $respostas = $_POST['publique']['respostas'];

    dbEpubliquev1::Inserir($Conexao, $perguntas, $respostas, $email);
    $msg = '<div class="card yellow lighten-3 col s10 offset-s1"><h3>Seu quiz foi enviado com sucesso!</h3></div>';
}
?>
<!DOCTYPE HTML>
<html>
    <head>

        <?php include 'masterpage/head.php'; ?>
    </head>
    <body>        
        <?php include 'masterpage/header.php'; ?>
        <h1 style="font-size: 2.1em;">Publique seu quiz online</h1>


        <div class="row">
            <?php echo $msg; ?>

            <div class="col s6">
                <p>Insira os dados de seu quiz</p>

                <form method="post">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="fm-publique-email" type="email" class="validate" name="publique[email]">
                            <label for="fm-publique-email" data-error="E-mail inválido" data-success="ok" class="">Email</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="fm-publique-perguntas" required class="materialize-textarea" class="validate" name="publique[perguntas]"></textarea>
                            <label for="fm-publique-perguntas">Perguntas</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="fm-publique-respostas" required class="materialize-textarea" class="validate" name="publique[respostas]"></textarea>
                            <label for="fm-publique-respostas">Respostas</label>
                        </div>
                    </div>

                    <button class="waves-effect waves-light btn light-green darken-3" id="btn-enviar">
                        <i class="material-icons left">done</i> 
                        Enviar quiz
                    </button>
                </form>
            </div>

            <div class="col s6">
                <p>Exemplo...</p>
                <p>
                    <b>Seu e-mail</b>
                    ex.: jose@hotmail.com
                </p>
                <p>
                    <b>Digite as perguntas conforme:</b>
                    <br />
                    <br />
                    Quiz: Personalidade pelas cores
                    <br />
                    1) Qual sua cor predileta?<br />
                    1a) verde<br />
                    1b) amarela<br />
                    1c) azul<br />
                    <br/>
                    2) Você prefere:<br />
                    2a) abacate<br />
                    2b) mamão<br />
                </p>

                <p>
                    <b>Digite as respostas conforme:</b> <br />
                    a) pessoa que gosta de verde e abacate <br />
                    Você gosta de verde e de abacate, sua personalidade é .... <br /> <br />
                    b) pessoa que gosta amarelo e mamão <br />
                    Você gosta de amarelo e mamão, sua personalidade é .... <br /> <br />
                    c) indeciso <br />
                    Indeciso ein? sua personalidade é ....
                </p>
            </div>
        </div>

        <?php include 'masterpage/footer.php'; ?>
    </body>
</html>