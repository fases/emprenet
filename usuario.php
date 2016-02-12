<?php
session_start();
include("acao_conexao.php");


// QUERY usuário
$sql = "select * from usuario where id=".$_GET['id'];

$usuario = mysqli_query($bd, $sql);

if (mysqli_num_rows($usuario)){
    $usuario = mysqli_fetch_array($usuario);
} else{
    die("Usuário não encontrado!");
}

// QUERY diarista
$sql = "select * from diarista where usuario=".$_GET['id'];
$diarista = mysqli_query($bd, $sql);

$isDiarista = mysqli_num_rows($diarista) ? true : false;
$diarista = $isDiarista ? mysqli_fetch_array($diarista) : null;

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
            <div class="row painel-centralizado">
                <h1 class="text-center">Perfil de <?php echo $usuario['nome']; ?></h1>

                <h2>Dados de usuário:</h2>
                <ul>
                    <li><strong>Nome: </strong><?php echo $usuario['nome']." ".$usuario['sobrenome']; ?></li>
                    <li><strong>Cidade: </strong><?php echo $usuario['cidade']; ?></li>
                    <li><strong>Estado: </strong><?php echo $usuario['uf']; ?></li>
                </ul>

                <?php if ($isDiarista) { ?>
                
                <h2>Perfil de diarista:</h2>
                <ul>
                    <li><strong>Aceitando trabalhos: </strong><?php echo $diarista['aceitando_trabalho'] == 1 ? "Sim" : "Não"; ?></li>
                    <?php
                    $categoria = mysqli_fetch_array(mysqli_query($bd, "select * from categoria where id=".$diarista['categoria']))['nome'];
                    ?>
                    <li><strong>Categoria: </strong><?php echo $categoria; ?></li>
                    <li><strong>Valor a hora: </strong>R$<?php echo $diarista['preco_por_hora']; ?></li>

                    <li><strong>Disponibilidade<br/><small>(M: manhã, T: tarde, N: noite)</small></strong>:
                        <ul>
                            <li><strong>Segunda: </strong>
                                <?php if ($diarista['disponibilidade_segunda']{0} == 1) echo "M"; ?>
                                <?php if ($diarista['disponibilidade_segunda']{1} == 1) echo "T"; ?>
                                <?php if ($diarista['disponibilidade_segunda']{2} == 1) echo "N"; ?></li>
                            <li><strong>Terça: </strong>
                                <?php if ($diarista['disponibilidade_terca']{0} == 1) echo "M"; ?>
                                <?php if ($diarista['disponibilidade_terca']{1} == 1) echo "T"; ?>
                                <?php if ($diarista['disponibilidade_terca']{2} == 1) echo "N"; ?></li>
                            <li><strong>Quarta: </strong>
                                <?php if ($diarista['disponibilidade_quarta']{0} == 1) echo "M"; ?>
                                <?php if ($diarista['disponibilidade_quarta']{1} == 1) echo "T"; ?>
                                <?php if ($diarista['disponibilidade_quarta']{2} == 1) echo "N"; ?></li>
                            <li><strong>Quinta: </strong>
                                <?php if ($diarista['disponibilidade_quinta']{0} == 1) echo "M"; ?>
                                <?php if ($diarista['disponibilidade_quinta']{1} == 1) echo "T"; ?>
                                <?php if ($diarista['disponibilidade_quinta']{2} == 1) echo "N"; ?></li>
                            <li><strong>Sexta: </strong>
                                <?php if ($diarista['disponibilidade_sexta']{0} == 1) echo "M"; ?>
                                <?php if ($diarista['disponibilidade_sexta']{1} == 1) echo "T"; ?>
                                <?php if ($diarista['disponibilidade_sexta']{2} == 1) echo "N"; ?></li>
                            <li><strong>Sábado: </strong>
                                <?php if ($diarista['disponibilidade_sabado']{0} == 1) echo "M"; ?>
                                <?php if ($diarista['disponibilidade_sabado']{1} == 1) echo "T"; ?>
                                <?php if ($diarista['disponibilidade_sabado']{2} == 1) echo "N"; ?></li>
                            <li><strong>Domingo: </strong>
                                <?php if ($diarista['disponibilidade_domingo']{0} == 1) echo "M"; ?>
                                <?php if ($diarista['disponibilidade_domingo']{1} == 1) echo "T"; ?>
                                <?php if ($diarista['disponibilidade_domingo']{2} == 1) echo "N"; ?></li>
                        </ul>
                    </li>
                </ul>
                
                <?php } ?>

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
