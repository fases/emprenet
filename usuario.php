<?php
session_start();
include("acao_conexao.php");

// session
$usuarioAtual = $_SESSION['usuario'] or die;
$idUsuarioAtual = isset($usuarioAtual) ? $usuarioAtual['id'] : 0;
$isAtualDiarista = $_SESSION['is_usuario_diarista'];

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
                    <?php
                    if ($isAtualDiarista){
                    ?>
                    <li><a href="diarista_editar.php"><i class="glyphicon glyphicon-tag"></i> Dados de diarista</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="ver_notificacoes.php"><i class="glyphicon glyphicon-bell"></i> Notificações</a></li>
                    <li><a href="historico.php"><i class="glyphicon glyphicon-briefcase"></i> Histórico</a></li>
                    <li><a href="boleto_sicredi.php"><i class="glyphicon glyphicon-usd"></i> Boleto bancário</a></li>
                    <li><a href="acao_logoff.php"><i class="glyphicon glyphicon-log-out"></i> Sair do Emprenet</a></li>
                </ul>
            </nav>
            
            <div class="main row painel-centralizado">
                <h1 class="text-center">Perfil de <?php echo $usuario['nome']; ?></h1>

                <h2><i class="glyphicon glyphicon-user"></i> Dados de usuário:</h2>
                <ul>
                    <li><strong>Nome: </strong><?php echo $usuario['nome']." ".$usuario['sobrenome']; ?></li>
                    <li><strong>Cidade: </strong><?php echo $usuario['cidade']; ?></li>
                    <li><strong>Estado: </strong><?php echo $usuario['uf']; ?></li>
                    <?php
                    $parteSql = "false";
                    if ($isDiarista)
                        $parteSql = "cliente=".$idUsuarioAtual." and diarista=".$usuario['id'];
                    else
                        $parteSql = "diarista=".$idUsuarioAtual." and cliente=".$usuario['id'];
                    $sql = "select * from notificacao where ".$parteSql." and diarista_aceitou=1";
                    $isContatosLiberados = mysqli_num_rows(mysqli_query($bd, $sql));
                    if ($isContatosLiberados){
                    ?>
                    <br/>
                    <li style="list-style: none; color: green;"><i class="glyphicon glyphicon-map-marker"></i> Novos dados disponíveis!</li>
                    <li><strong>E-mail: </strong><?php echo $usuario['email']; ?></li>
                    <li><strong>Endereço: </strong><?php echo $usuario['endereco']; ?></li>
                    <?php } ?>
                </ul>

                <?php if ($isDiarista) { ?>

                <h2><i class="glyphicon glyphicon-tag"></i> Perfil de diarista:</h2>
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

                <br/>

                <?php if($isDiarista){ ?>
                <?php if($isContatosLiberados){ ?>
                <div class="row">
                    <form id="fmComentario" method="post" action="acao_comentar_diarista.php">
                        <h2><i class="glyphicon glyphicon-pencil"></i> Avalie!</h2>

                        <input type="hidden" name="diarista" value="<?php echo $usuario['id']; ?>"/>
                        
                        <span>Nota dos serviços:</span>
                        <select class="form-control" name="avaliacao" required>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5" selected>5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>

                        <span>Comentário <small>(tente usar poucas palavras, máximo 2500 caracteres)</small>:</span>
                        <textarea class="form-control" name="detalhes" maxlength="2500" required></textarea>

                        <br/>
                        <button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-send"></i> Comentar</button>
                    </form>
                </div>

                <?php }else{ ?>
                <div class="text-center">
                    
                    <form id="fmContatoNotificacao" method="get" action="acao_notificar_diarista.php">
                        <h2><i class="glyphicon glyphicon-phone-alt"></i> Solicite o contato de <?php echo $usuario['nome']; ?>!<br/>
                            <small>Você envia a solicitação e espera uma resposta...</small></h2>

                        <p>
                         Se o(a) diarista concordar, o contato dele(a) estará visível na próxima vez que você acessar <strong>este perfil</strong>, para que você possa entrar em melhor contato, se encontrarem ou combinarem algo mais adequado.
                        </p>
                        
                        <p>
                        No campo de <strong>proposta</strong> abaixo, use poucas palavras, mas diga quais dias da semana deseja que o serviço seja, pretensão salarial, turnos, fale um pouco de você, como seria a rotina de trabalho etc.
                        </p>
                        
                        <p>
                        <strong>Este é seu "convite" para o(a) diarista,<br/><small>seja respeitoso(a)</small>!</strong>
                        </p>
                        
                        <input type="hidden" name="usuarioDiarista" value="<?php echo $diarista['usuario']; ?>"/>
                        
                        <h3>Sua proposta:</h3>
                        <textarea class="form-control" name="mensagem" maxlength="2500" required></textarea>

                        <br/>
                        <button type="submit" class="btn btn-success pull-success"><i class="glyphicon glyphicon-flag"></i> Contatar</button>
                    </form>
                    
                </div>
                <?php } ?>
                <?php } ?>

                <div class="row">
                    <h2><i class="glyphicon glyphicon-comment"></i> Outros comentários:</h2>
                    <ul>
                        <?php
                        $sql = "select * from comentario where diarista=".$usuario['id'];
                        $comentarios = mysqli_query($bd, $sql);
                        while($comentario = mysqli_fetch_array($comentarios)){
                            $clienteAutor = mysqli_fetch_array(mysqli_query($bd, "select * from usuario where id=".$comentario['cliente_autor']));
                        ?>
                        <li><strong><a href="usuario.php?id=<?php echo $clienteAutor['id']; ?>"><?php echo $clienteAutor['nome']." ".$clienteAutor['sobrenome']; ?></a></strong> avaliou...
                            <ul>
                                <li><strong>Nota: </strong> <?php echo $comentario['avaliacao']; ?></li>
                                <li><strong>Comentário: </strong> <?php echo $comentario['detalhes']; ?></li>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
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
