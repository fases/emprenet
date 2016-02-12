<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Emprenet</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

        <!-- Custom styles for this template -->
        <link href="css/emprenet/padrao.css" rel="stylesheet">
        <link href="css/emprenet/index.css" rel="stylesheet">

    </head>
    <!-- NAVBAR
================================================== -->
    <body>
        <div class="navbar-wrapper">
            <div class="container">

                <nav class="navbar navbar-inverse navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Alterar navegação</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"><strong>Emprenet</strong></a>
                        </div>
                        <div id="navbar" class="navbar-collapse navbar-right collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="index.php">Início</a></li>
                                <li><a href="sobre.php">Quem somos</a></li>
                                <li><a href="login.php">Acessar conta</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>


        <!-- Carousel
================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            </ol>
            <div class="carousel-inner" role="listbox">

                <div class="item active" id="carousel-1">
                    <div class="container">
                        <div class="carousel-caption">
                            <form method="get" action="busca_diarista.php">
                                <img src="css/emprenet/img/logo.jpg" width="340" height="80"/>
                                <h1>Encontre diaristas na sua região!</h1>
                                <input type="hidden" name="porLocal" value="porLocal"/>
                                <input type="search" name="cidade" class="form-control" placeholder="Digite o nome da cidade..." />
                                <br/>
                                <button class="btn btn-lg btn-success" role="submit"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.carousel -->


        <!-- Marketing messaging
================================================== -->

        <div class="container marketing">

            <div class="row">
                    
                <div class="col-lg-4">
                    <img src="css/emprenet/img/empresario-mostrando-graficos.jpg" class="img-circle" alt="Generic placeholder image" width="130" height="130">
                    <h2>Como funciona?</h2>
                    <p>Diarista ou cliente contratante: na Emprenet você poderá utilizar nossa rede de usuários para achar o melhor negócio a suprir suas necessidades.</p>
                    <p><a class="btn btn-default" href="#" role="button">Experimente um teste &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                
                <div class="col-lg-4">
                    <img src="css/emprenet/img/patroa-feliz-no-laptop.jpg" class="img-circle" alt="Generic placeholder image" width="130" height="130">
                    <h2>Cadastre-se, cliente!</h2>
                    <p>Após o cadastro, você poderá pesquisar livremente o currículo, disponbilidade e habilidades de diaristas a fim de firmar um contrato.</p>
                    <p><a class="btn btn-default" href="usuario_novo.php" role="button">Cliente &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                
                <div class="col-lg-4">
                    <img src="css/emprenet/img/diarista-feliz.jpg" class="img-circle" alt="Generic placeholder image" width="130" height="130">
                    <h2>Cadastre-se, diarista!</h2>
                    <p>Siga poucos passos para poder começar a divulgar o seu trabalho e encontrar um emprego adequado às suas habilidades.</p>
                    <p><a class="btn btn-default" href="usuario_novo.php" role="button">Diarista &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                
            </div><!-- /.row -->

        </div><!-- /.container -->

        <!-- FEATURETTES -->
        <div class="chamada-maior">
            <div class="container">
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Emprenet <span class="text-muted">trás a você o melhor contrato de diarista.</span></h2>
                        <p class="lead">É através de nossa rede de usuários que milhares de brasileiros já encontraram o negócio adequado e estão felizes trabalhando com pessoas capacitadas e adequadas a cada serviço. Não fique de fora!</p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-responsive center-block" src="css/emprenet/img/cena-meio-machista-patriarcal.jpg" alt="Generic placeholder image">
                    </div>
                </div>

                <hr class="featurette-divider">
            </div>
        </div>
        <!-- /END THE FEATURETTES -->


        <!-- FOOTER -->
        <footer>
            <div class="container">
                <p class="pull-right"><a href="#">Voltar ao topo</a></p>
                <p><strong>Desenvolvido pelo projeto <a href="https://github.com/fases/" target="_blank">FASES</a></strong></p>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>
