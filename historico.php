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
                                <li><a href="login.php">Acessar conta</a></li>
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
                    <?php } else{ ?>
                    <?php } ?>
                    <li><a href="ver_notificacoes.php"><i class="glyphicon glyphicon-bell"></i> Notificações</a></li>
                    <li><a href="historico.php"><i class="glyphicon glyphicon-briefcase"></i> Histórico</a></li>
                    <li><a href="boleto_sicredi.php"><i class="glyphicon glyphicon-usd"></i> Boleto bancário</a></li>
                    <li><a href="acao_logoff.php"><i class="glyphicon glyphicon-log-out"></i> Sair do Emprenet</a></li>
                </ul>
            </nav>

            <div class="main row painel-centralizado">
                <h1 class="text-center">Histórico de <?php echo $usuarioAtual['nome']; ?></h1>

                <?php
                $idUsuarioAtual = $usuarioAtual['id'];
                $sql = "select * from notificacao where cliente=$idUsuarioAtual or diarista=$idUsuarioAtual";
                $notificacoes = mysqli_query($bd, $sql);
                ?>

                <h2><i class="glyphicon glyphicon-time"></i> Registro de notificações recebidas e enviadas:</h2>

                <ul>
                    <?php
                    while($notificacao = mysqli_fetch_array($notificacoes)){
                        $outroUsuario = mysqli_fetch_array(mysqli_query($bd, "select * from usuario where id=".($idUsuarioAtual == $notificacao['diarista'] ? $notificacao['cliente'] : $notificacao['diarista'])));
                    ?>
                    <li>
                        <h3><strong><a href="usuario.php?id=<?php echo $outroUsuario['id']; ?>"><?php echo $outroUsuario['nome']." ".$outroUsuario['sobrenome']; ?></a></strong> <?php echo $idUsuarioAtual == $notificacao['diarista'] ? " contatou você" : "foi contatado por você"; ?>. E a resposta foi <?php echo $notificacao['diarista_aceitou']=='1' ? "positiva" : ($notificacao['diarista_aceitou']=='0' ? "negativa" : "nenhuma ainda");?>.</h3>
                    </li>
                    <?php } ?>
                </ul>

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
