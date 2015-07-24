<footer class="page-footer light-green darken-3">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Quiz.com.br</h5>
                <p class="grey-text text-lighten-4">O melhor site para jogo de quiz.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text"><?php echo ___siteTitle; ?></h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="/">Home</a></li>
                    <li><a class="grey-text text-lighten-3" href="/random-quiz.php">Novos</a></li>
                    <li><a class="grey-text text-lighten-3" href="/mais-votados.php">+Votados</a></li>
                    <li><a class="grey-text text-lighten-3" href="/publique.php">Publique seu quiz</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright light-green darken-4">
        <div class="container">
            © 2015 - <?php echo ___siteTitle; ?>
        </div>
    </div>
</footer>

<script type='text/javascript' src='/jquerycms/js/jquery.validate.min.js'></script>
<script>
    $(document).ready(function () {
        $(".button-collapse").sideNav();
        $('select').material_select();
        $('select').material_select('destroy');
    });
</script>