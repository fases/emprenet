<?php
session_start();
include("acao_conexao.php");

$sql = "select * from diarista where true";

// filtro nome
if (isset($_GET['porNome'])){
    $nome = $_GET['nome'];

    $sqlAux = "select * from usuario where nome='$nome' or sobrenome='$nome'";
    $resAux = mysqli_query($bd, $sqlAux);

    $aux = "";
    while ($usuario = mysqli_fetch_array($resAux)){
        $id = $usuario['id'];
        $aux .= "usuario=$id or ";
    }

    if ($aux!=""){
        $sql .= " and (".$aux." 1=0)";
    } else{
        $sql .= " and (false)";
    }
}

// filtro local
if (isset($_GET['porLocal'])){
    $cidade = isset($_GET['cidade'])? $_GET['cidade'] : "";
    $uf = isset($_GET['uf']) ? $_GET['uf'] : "";

    $sqlAux = "select * from usuario where cidade='$cidade' or uf='$uf' ";
    $resAux = mysqli_query($bd, $sqlAux);

    $aux = "";
    while ($usuario = mysqli_fetch_array($resAux)){
        $id = $usuario['id'];
        $aux .= "usuario=$id or ";
    }

    if ($aux!=""){
        $sql .= " and (".$aux." 1=0)";
    } else{
        $sql .= " and (false)";
    }
}

// filtro valor mínimo
if (isset($_GET['porPrecoMin'])){
    $min = $_GET['min'];

    $sql .= " and (preco_por_hora >= $min)";
}

// filtro valor máximo
if (isset($_GET['porPrecoMax'])){
    $max = $_GET['max'];

    $sql .= " and (preco_por_hora <= $max)";
}

// filtro categoria
if (isset($_GET['porCategoria'])){
    $categoria = $_GET['categoria'];
    
    if (!($categoria=='0')){
        $sql .= " and (categoria=$categoria)";
    }
}

// QUERY!
$diaristas = mysqli_query($bd, $sql);

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
            <div class="row painel-centralizado-maior resultados-pesquisa">
                <h2 class="text-center">Resultados da pesquisa (<?php echo mysqli_num_rows($diaristas); ?>):</h2>

                <?php
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
                                <p>
                                    <?php if(isset($_SESSION['usuario'])){ ?>
                                    <a href="usuario.php?id=<?php echo $diarista['usuario']; ?>">
                                    <?php }else{?>
                                    <a href="login.php">
                                    <?php } ?>
                                        Ver mais...
                                    </a>
                                </p>
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
