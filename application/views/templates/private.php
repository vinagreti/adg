<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Arte del Gusto</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/third-party/twitter-bootstrap3/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
/* make sidebar nav vertical */ 
@media (min-width: 768px) {
  .sidebar-nav .navbar .navbar-collapse {
    padding: 0;
    max-height: none;
  }
  .sidebar-nav .navbar ul {
    float: none;
    display: block;
  }
  .sidebar-nav .navbar li {
    float: none;
    display: block;
  }
  .sidebar-nav .navbar li a {
    padding-top: 12px;
    padding-bottom: 12px;
  }
}

.jumbotron {
    padding-bottom: 0;
    padding-top: 0;
    margin-bottom:10px;
    height: 160px;

    /* IE9 SVG, needs conditional override of 'filter' to 'none' */
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzhmYzQwMCIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjklIiBzdG9wLWNvbG9yPSIjOGZjNDAwIiBzdG9wLW9wYWNpdHk9IjAiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzhmYzQwMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
    background: -moz-linear-gradient(left, rgba(143,196,0,0) 0%, rgba(143,196,0,0) 9%, rgba(143,196,0,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(143,196,0,0)), color-stop(9%,rgba(143,196,0,0)), color-stop(100%,rgba(143,196,0,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(left, rgba(143,196,0,0) 0%,rgba(143,196,0,0) 9%,rgba(143,196,0,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(left, rgba(143,196,0,0) 0%,rgba(143,196,0,0) 9%,rgba(143,196,0,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(left, rgba(143,196,0,0) 0%,rgba(143,196,0,0) 9%,rgba(143,196,0,1) 100%); /* IE10+ */
    background: linear-gradient(to right, rgba(143,196,0,0) 0%,rgba(143,196,0,0) 9%,rgba(143,196,0,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#008fc400', endColorstr='#8fc400',GradientType=1 ); /* IE6-8 */
}

.jumbotron img{

    height:160px;

}
.img-button{
    height: 190px;
    width: 100%;
}
.img-button:hover{
    opacity: 0.5;
}

.font-papyrus-fantasy{
    font-family: Papyrus, fantasy;
    font-weight: bold;
    font-size: 17px;
}

.fa-facebook-square{color:#555555;}
.fa-facebook-square:hover{color:#46629E;}
</style>

    <!-- Carrega css dinamicamente -->
    <?php if( isset($arquivos_css) ) foreach( $arquivos_css as $key => $css ) echo '<link href="'.base_url().'assets/'.$css.'.css" rel="stylesheet">'; ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron font-papyrus-fantasy">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <img style="max-width:100%; max-height:100%;" src="https://s3-sa-east-1.amazonaws.com/artedelgusto/static/menina_transparent_feita.png">
                </div>
                <div class="col-md-10">
                    <h1>Arte del Gusto</h1>
                    <p>...o atelier do sabor.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-2" role="main">

                <div class="sidebar-nav">

                    <div class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="visible-xs navbar-brand">Sidebar menu</span>
                        </div>
                        <div class="navbar-collapse collapse sidebar-navbar-collapse font-papyrus-fantasy">
                            <ul class="nav navbar-nav">
                                <li <?php if($this->router->fetch_class() == 'welcome') echo 'class="active"'; ?> ><a href="<?=base_url()?>">Bem vindo</a></li>
                                <li <?php if($this->router->fetch_class() == 'quemsomos') echo 'class="active"'; ?>><a href="quemsomos">Quem somos</a></li>
                                <li <?php if($this->router->fetch_class() == 'cardapio') echo 'class="active"'; ?>><a href="cardapio">Cardápio</a></li>
                                <li <?php if($this->router->fetch_class() == 'contato') echo 'class="active"'; ?>><a href="contato">Fale conosco</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->

                    </div>

                </div>

            </div>

            <div class="col-md-10" role="main">
                <?= $conteudo ?>
            </div>

        </div>

        <hr>

        <footer>
            <address class="text-center">
                <div class="social-medias">
                    <a href="https://www.fb.com/artedgusto" target="_blank"><i class="fa fa-facebook-square fa-3x"></i></a>
                </div>
                Capivari de Baixo - SC - 88745-000<br>
                +55 48 36234246</br>
                <a href="mailto:contato@artedelgusto.com.br">contato@artedelgusto.com.br</a>
            </address>
        </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>assets/third-party/JQuery/jquery-1.10.2.js"></script>
    <script src="<?=base_url()?>assets/third-party/twitter-bootstrap3/js/bootstrap.min.js"></script>
    <!-- Carrega scripts dinamicamente -->
    <?php if( isset($arquivos_js) ) foreach( $arquivos_js as $key => $script ) echo '<script src="'.base_url().'assets/'.$script.'.js"></script>'; ?>
</body>
</html>
