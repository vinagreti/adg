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
}

.img-button:hover{
    opacity: 0.5;
}

body{
    font-family: Papyrus, fantasy;
}
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
    <div class="jumbotron">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <img style="max-width:100%; max-height:100%;" src="https://s3-sa-east-1.amazonaws.com/artedelgusto/static/menina_transparent_feita.png">
                </div>
                <div class="col-md-10">
                    <h1>Arte del Gusto</h1>
                    <p>Sinta-se a vontade para conhecer nosso atelier do sabor.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-3" role="main">

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
                        <div class="navbar-collapse collapse sidebar-navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="">Bem vindo</a></li>
                                <li><a href="quemsomos">Quem somos</a></li>
                                <li><a href="cardapio">Cardápio</a></li>
                                <li><a href="contato">Fale conosco</li>
                            </ul>
                        </div><!--/.nav-collapse -->

                        <ul class="nav navbar-nav"><li><a href="https://www.fb.com/artedgusto" target="_blank"><i class="fa fa-facebook-square fa-3x" style="color:#46629E;"></i></a></li></ul>

                        <address class="text-center">
                            Capivari de Baixo - SC - 88745-000<br>
                            +55 48 36234246</br>
                            <a href="mailto:contato@artedelgusto.com.br">contato@artedelgusto.com.br</a>
                        </address>
                    </div>

                </div>

            </div>

            <div class="col-md-9" role="main">
                <?= $conteudo ?>
            </div>

        </div>

    </div>

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