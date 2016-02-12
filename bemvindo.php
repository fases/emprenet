<?php
session_start();
include("acao_conexao.php");
$usuarioAtual = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
$isAtualDiarista = $_SESSION['is_usuario_diarista'];
?>

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
        <link href="css/emprenet/dashboard.css" rel="stylesheet">

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
                                <li><a href="index.php">Início</a></li>
                                <li><a href="#">Quem somos</a></li>
                                <li class="active"><a href="login.php">Acessar conta</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>

        <div class="container">

            <nav class="pull-left menu-lateral">
                <p class="text-center">
                    <img src="css/emprenet/img/patroa-feliz-no-laptop.jpg" class="img-circle" alt="Imagem de perfil" width="130" height="130"/>
                    <br/><br/>
                    <strong><?php echo $usuarioAtual['nome'] . ' ' . $usuarioAtual['sobrenome']; ?></strong>
                </p>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="usuario_editar.php"><i class="glyphicon glyphicon-user"></i> Dados de usuário</a></li>
                    <?php if ($isAtualDiarista){ ?>
                    <li><a href="diarista_editar.php"><i class="glyphicon glyphicon-tag"></i> Dados de diarista</a></li>
                    <?php } ?>
                    <li class="disabled"><a href="#"><i class="glyphicon glyphicon-usd"></i> Gerar boleto bancário</a></li>
                    <li><a href="acao_logoff.php"><i class="glyphicon glyphicon-log-out"></i> Sair do Emprenet</a></li>
                </ul>
            </nav>

            <div class="main">
                <div class="painel-centralizado-maior text-center">
                    <h1>Bem-vindo(a) à Emprenet, <?php echo $usuarioAtual['nome']; ?>!</h1>

                    <form method="get" action="busca_diarista.php">
                        <h2>Buscando diaristas?</h2>

                        <div class="input-group">
                            <span class="input-group-addon"><input type="checkbox" name="porNome" value="porNome"></span>
                            <input type="text" name="nome" class="form-control" placeholder="Por nome OU sobrenome" />
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><input type="checkbox" name="porLocal" value="porLocal"></span>
                            <input type="text" name="cidade" class="form-control" placeholder="Por cidade..." />
                            <select class="form-control" name="uf">
                                <option value="0">... e estado</option>
                                <option value="AC">Acre (AC) </option>
                                <option value="AL">Alagoas (AL) </option>
                                <option value="AP">Amapá (AP) </option>
                                <option value="AM">Amazonas (AM) </option>
                                <option value="BA">Bahia (BA) </option>
                                <option value="CE">Ceará (CE) </option>
                                <option value="DF">Distrito Federal (DF) </option>
                                <option value="ES">Espírito Santo (ES) </option>
                                <option value="GO">Goiás (GO) </option>
                                <option value="MA">Maranhão (MA) </option>
                                <option value="MT">Mato Grosso (MT) </option>
                                <option value="MS">Mato Grosso do Sul (MS) </option>
                                <option value="MG">Minas Gerais (MG) </option>
                                <option value="PA">Pará (PA) </option>
                                <option value="PB">Paraíba (PB) </option>
                                <option value="PR">Paraná (PR) </option>
                                <option value="PE">Pernambuco (PE) </option>
                                <option value="PI">Piauí (PI) </option>
                                <option value="RJ">Rio de Janeiro (RJ) </option>
                                <option value="RN">Rio Grande do Norte (RN) </option>
                                <option value="RS">Rio Grande do Sul (RS) </option>
                                <option value="RO">Rondônia (RO) </option>
                                <option value="RR">Roraima (RR) </option>
                                <option value="SC">Santa Catarina (SC) </option>
                                <option value="SP">São Paulo (SP) </option>
                                <option value="SE">Sergipe (SE) </option>
                                <option value="TO">Tocantins (TO) </option>
                            </select>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><input type="checkbox" name="porCategoria" value="porCategoria"></span>
                            <select class="form-control" name="categoria">
                                <option value="0">Por categoria</option>
                                <?php
                                $sql = "select * from categoria";
                                $res = mysqli_query($bd, $sql);
                                while ($categoria = mysqli_fetch_array($res)){
                                ?>
                                <option value="<?php echo $categoria['id']; ?>">
                                    <?php echo $categoria['nome']; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><input type="checkbox" name="porPrecoMin" value="porPrecoMin"></span>
                            <span class="input-group-addon">R$</span>
                            <input type="number" name="min" class="form-control" placeholder="Por preço mínimo" />
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><input type="checkbox" name="porPrecoMax" value="porPrecoMax"></span>
                            <span class="input-group-addon">R$</span>
                            <input type="number" name="max" class="form-control" placeholder="Por preço máximo" />
                        </div>

                        <br/>
                        <p><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> Buscar</button></p>
                    </form>

                </div>

                <br/>

                <div class="row painel-centralizado-maior top">
                    <h2 class="text-center">Top diaristas<br/><small>No momento esta área está em construção...</small></h2>

                    <div class="media">
                        <div class="media-left media-middle">
                            <img src="css/emprenet/img/diarista-feliz.jpg" class="img-circle media-object" width="100" height="100" />
                        </div>
                        <div class="media-body">
                            <div class="row">
                                <div class="col-md-6"><p><strong>Nome: </strong>Fulana da Silva</p></div>
                                <div class="col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Valor: </strong>R$100,00</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Categoria: </strong>Faxineira</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <strong>Nota:</strong>
                                        <i class="glyphicon glyphicon-heart"></i>
                                        <i class="glyphicon glyphicon-heart"></i>
                                        <i class="glyphicon glyphicon-heart"></i>
                                        <i class="glyphicon glyphicon-heart-empty"></i>
                                        <i class="glyphicon glyphicon-heart-empty"></i>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><a href="#">Ver mais...</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

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
