<!DOCTYPE html>
<html>
    <head>

        <title>Mako Framework</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="/favicon.ico">
        <link type="text/css" rel="stylesheet" href="/assets/css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="http://makoframework.com/assets/css/animate.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="http://makoframework.com/assets/css/mako.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="http://makoframework.com/assets/css/backtotop.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="http://makoframework.com/assets/css/prism.css"  media="screen,projection"/>

        <script>
            var mako = {'base_url': 'http://makoframework.com/'};
        </script>

        <script>
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-19891169-1']);
            _gaq.push(['_setDomainName', '.makoframework.com']);
            _gaq.push(['_trackPageview']);
            (function ()
            {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </head>

    <body>

        <ul id="source-dropdown" class="dropdown-content nav-dropdown">
            <li><a href="http://makoframework.com/contributing/contributors">Contributors</a></li>
            <li><a href="https://github.com/mako-framework">View on GitHub</a></li>
        </ul>

        <nav id="nav" class="grey darken-3-5">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="http://makoframework.com/" class="brand-logo"><img src="http://makoframework.com/assets/img/logo50.png" alt="Mako"></a>
                    <ul id="nav-mobile" class="right side-nav">
                        <li><a href="http://makoframework.com/docs">Documentation</a></li>
                        <li><a href="http://api.makoframework.com">API</a></li>
                        <li>
                            <a class="dropdown-button" href="#!" data-activates="source-dropdown">Source<i class="mdi-navigation-arrow-drop-down right"></i></a>
                        </li>
                        <li><a href="https://github.com/mako-framework/framework/issues">Issues</a></li>
                        <li><a href="http://forum.makoframework.com/">Community</a></li>
                        <li><a href="#!" id="toggle-search"><i class="large mdi-action-search"></i></a></li>
                    </ul>
                    <a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>
                </div>
            </div>
        </nav>

        <div class="row white-text grey darken-3" id="search">

            <div class="container">
                <form action="https://www.google.com/search" method="get">
                    <input class="form-control" type="text" name="q" placeholder="Search ...">
                    <input type="hidden" name="as_sitesearch" value="makoframework.com">
                </form>
            </div>

        </div>

        <div id="content">




            <div class="hero parallax-effect">
                <div class="container">
                    <div class="hero-content animated bounceInDown slow">
                        <h1>Hello, world!</h1>
                        <p>Mako is a lightweight and easy to use PHP framework.</p>
                        <p>Check out the <a href="http://makoframework.com/docs">documentation</a> and create something awesome!</p>
                    </div>
                </div>
            </div>

            <div class="grey lighten-3 get-started">
                <div class="container">

                    <div class="terminal-window">
                        <div class="terminal-menu">
                            <div class="pull-left"><div class="circle circle-red"></div> <div class="circle circle-yellow"></div> <div class="circle circle-green"></div></div>
                            Get started with one single command!
                        </div>
                        <div class="terminal-body">
                            <div>foo@server:~$ cd /srv/www</div>
                            <div>foo@server:/srv/www$ <span class="command">composer create-project mako/app:4.* &lt;project name&gt;</span> <div class="cursor"></div></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="white">
                <div class="container">

                    <div class="row nomargin promo">
                        <div class="col s12 m4 l4">
                            <p><i class="mdi-action-accessibility"></i></p>
                            <p>Open source</p>
                            <p>Mako is an open source project licensed under the <a href="http://makoframework.com/license">BSD License</a>. This means that you can use and modify it for both commercial and open source purposes.</p>
                        </div>
                        <div class="col s12 m4 l4">
                            <p><i class="mdi-image-timer"></i></p>
                            <p>Fast & lightweight</p>
                            <p>Mako is fast and lightweight and will allow you to serve high traffic websites on modest hardware.</p>
                        </div>
                        <div class="col s12 m4 l4">
                            <p><i class="mdi-device-storage"></i></p>
                            <p>Database agnostic</p>
                            <p>Develop your application without having to worry about which RDBMS it is going to be deployed on.</p>
                        </div>
                    </div>

                    <div class="row nomargin promo">
                        <div class="col s12 m4 l4 offset-m2 offset-l2">
                            <p><i class="mdi-maps-layers"></i></p>
                            <p>Composer</p>
                            <p>Install and update Mako as well as third party packages and libraries using <a href="https://packagist.org/">composer</a>.</p>
                        </div>
                        <div class="col s12 m4 l4">
                            <p><i class="mdi-hardware-laptop-mac"></i></p>
                            <p>Developer API</p>
                            <p>Well documented <a href="http://api.makoframework.com">source code</a> makes it easy to understand whats going on.</p>
                        </div>
                    </div>

                </div>
            </div>


        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Git</h5>
                        <p class="grey-text lighten-4 github"></p>
                        <p>
                            <a href="https://travis-ci.org/mako-framework/framework">
                                <img src="https://travis-ci.org/mako-framework/framework.svg?branch=master" alt="">
                            </a>
                        </p>
                        <p>
                            <a class="waves-effect waves-light btn grey darken-1" href="https://github.com/mako-framework/framework/issues">
                                <span id="open-issues">?</span> Open Issues
                            </a>
                            <a class="waves-effect waves-light btn grey darken-1" href="https://github.com/mako-framework/framework/pulls">
                                <span id="pull-requests">?</span> Pull Requests
                            </a>
                        </p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Links</h5>
                        <ul>
                            <li><a class="grey-text lighten-3" href="http://makoframework.com/">Home</a></li>
                            <li><a class="grey-text lighten-3" href="http://makoframework.com/changelog">Changelog</a></li>
                            <li><a class="grey-text lighten-3" href="http://makoframework.com/docs">Documentation</a></li>
                            <li><a class="grey-text lighten-3" href="http://api.makoframework.com">API</a></li>
                            <li><a class="grey-text lighten-3" href="https://github.com/mako-framework/framework/issues">Issues</a></li>
                            <li><a class="grey-text lighten-3" href="http://forum.makoframework.com">Community</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2015 Frederic G. Østby - All Rights Reserved
                    <a class="grey-text lighten-4 right" href="https://twitter.com/makoframework">&nbsp;<i class="fa fa-twitter"></i></a>
                    <a class="grey-text lighten-4 right" href="https://github.com/mako-framework">&nbsp;<i class="fa fa-github-alt"></i></a>
                </div>
            </div>
        </footer>

        <a href="#0" class="cd-top">Top</a>

        <script type="text/javascript" src="http://makoframework.com/assets/js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="http://makoframework.com/assets/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://makoframework.com/assets/js/materialize.min.js"></script>
        <script type="text/javascript" src="http://makoframework.com/assets/js/timeago.min.js"></script>
        <script type="text/javascript" src="http://makoframework.com/assets/js/mako.js"></script>
        <script type="text/javascript" src="http://makoframework.com/assets/js/prism.js"></script>
        <script type="text/javascript" src="http://makoframework.com/assets/js/backtotop.js"></script>

    </body>
</html>