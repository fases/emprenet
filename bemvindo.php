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
                                <li><a href="sobre.php">Quem somos</a></li>
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
                    <?php
                    $parteSql = "";
                    if ($isAtualDiarista){
                        $parteSql = "diarista=".$usuarioAtual['id']." and diarista_aceitou is null";
                    ?>
                    <li><a href="diarista_editar.php"><i class="glyphicon glyphicon-tag"></i> Dados de diarista</a></li>
                    <?php
                    } else{
                        $parteSql = "cliente=".$usuarioAtual['id']." and diarista_aceitou=1 and cliente_ok=0";
                    }
                    ?>
                    <li><a href="ver_notificacoes.php"><i class="glyphicon glyphicon-bell" <?php echo mysqli_num_rows(mysqli_query($bd, "select * from notificacao where $parteSql")) ? " style='color: #f1c40f' " : ""; ?>></i> Notificações</a></li>
                    <li><a href="historico.php"><i class="glyphicon glyphicon-briefcase"></i> Histórico</a></li>
                    <li><a href="boleto_sicredi.php"><i class="glyphicon glyphicon-usd"></i> Boleto bancário</a></li>
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
                                <option value="0">... e estado (selecione)</option>
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
                                <option value="0">Por categoria (selecione)</option>
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
                    <h2 class="text-center">Top diaristas<br/><small>Melhores diaristas!</small></h2>

                    <?php
                    
                    $sql = "select diarista.*, comentario.* from diarista inner join comentario on diarista.usuario = comentario.diarista order by comentario.avaliacao desc limit 10";
                    $diaristas = mysqli_query($bd, $sql);
                    /*
                    $comentarios = mysqli_query($bd, $sql);
                    $sql = "";
                    while ($comentario = mysqli_fetch_array($comentarios)){
                        $sql .= "or usuario=".$comentario['diarista'];
                    }
                    
                    $sql = "select * from diarista where 0=1 $sql";
                    $diaristas = mysqli_query($bd, $sql);
                    */
                    while ($diarista = mysqli_fetch_array($diaristas)){
                    ?>
                    <div class="media">
                        <div class="media-left media-middle">
                            <img src="css/emprenet/img/diarista-feliz.jpg" class="img-circle media-object" width="100" height="100" />
                        </div>
                        <div class="media-body">
                            <div class="row">
                                <?php
                        $usuario = mysqli_fetch_array(mysqli_query($bd, "select * from usuario where id=".$diarista['usuario']));
                        $usuario = $usuario['nome']." ".$usuario['sobrenome'];
                                ?>
                                <div class="col-md-6"><p><strong>Nome: </strong><?php echo $usuario; ?></p></div>
                                <div class="col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Valor hora: </strong>R$<?php echo $diarista['preco_por_hora']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <?php
                        $categoria = mysqli_fetch_array(mysqli_query($bd, "select * from categoria where id=".$diarista['categoria']))['nome'];
                                    ?>
                                    <p><strong>Categoria: </strong><?php echo $categoria; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <?php
                        $sql = "select * from comentario where diarista=".$diarista['usuario'];
                        $comentarios = mysqli_query($bd, $sql);
                        $media = 0;
                        while ($comentario = mysqli_fetch_array($comentarios)){
                            $media += $comentario['avaliacao'];
                        }
                        $media = $media / mysqli_num_rows($comentarios); // porcentagem
                        $qtdCoracoes = (int) ($media * 0.5); // calc proporção
                                        ?>
                                        <strong>Nota: </strong> (<?php echo $media; ?> de 10)
                                        <?php for ($i = 0; $i < $qtdCoracoes; $i++){ ?>
                                        <i class="glyphicon glyphicon-heart"></i>
                                        <?php }
                        for ($i = 0; $i < 5 - $qtdCoracoes; $i++){
                                        ?>
                                        <i class="glyphicon glyphicon-heart-empty"></i>
                                        <?php } ?>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><a href="usuario.php?id=<?php echo $diarista['usuario']; ?>">Ver mais...</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

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
