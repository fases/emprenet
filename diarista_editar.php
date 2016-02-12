<?php
session_start();
include("acao_conexao.php");
$usuarioAtual = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
$diaristaAtual = mysqli_fetch_array(mysqli_query($bd, "select * from diarista where usuario=".$usuarioAtual['id']));
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
        <link href="css/emprenet/tabela_disponibilidade.css" rel="stylesheet">

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
            <form class="painel-centralizado" method="post" action="acao_editar_diarista.php">
                <h1>Atualizar dados de diarista</h1>

                <strong>Categoria:</strong>
                <select class="form-control" name="categoria">
                    <?php
                    $sql = "select * from categoria";
                    $res = mysqli_query($bd, $sql);
                    while ($categoria = mysqli_fetch_array($res)){
                    ?>
                    
                    <option <?php if ($diaristaAtual['categoria'] == $categoria['id']) echo "selected"; ?> value="<?php echo $categoria['id']; ?>">
                        <?php echo $categoria['nome']; ?>
                    </option>
                    
                    <?php
                    }
                    ?>
                </select>
                
                <br/>
                <strong>Pretensão de valor cobrado por hora:</strong><br/><small>(Se houver centavos, utilize como separador o <strong>ponto</strong>, não vírgula)</small>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">R$</span>
                    <input name="preco" type="number" value="<?php echo $diaristaAtual['preco_por_hora']; ?>" step="any" class="form-control" placeholder="0.00" aria-describedby="basic-addon1" required/>
                </div>

                <br/>
                <span>Informações adicionais:</span><br/><small></small>
                <textarea name="sobre" class="form-control" placeholder="Escreva uma pequena biografia, experiências profissionais, habilidades, hobbies, o que quiser dizer expor."><?php echo $diaristaAtual['sobre']; ?></textarea>

                <br/>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" name="disponivel" value="disponivel" aria-label="..." <?php if ($diaristaAtual['aceitando_trabalho']) echo "checked"; ?>>
                    </span>
                    <input type="text" value="Estou aceitando trabalhos no momento." class="form-control" aria-label="..." readonly/>
                </div>
                
                <br/>
                <strong>Marque os dias e turnos em que você está disponível para trabalhar no momento:</strong>
                <br/>
                <small>(Mantenha esta tabela sempre bem atualizada)</small>
                <br/><br/>
                <table class="disponibilidade text-center">
                    <tr>
                        <td></td>
                        <td>Domingo</td>
                        <td>Segunda</td>
                        <td>Terça</td>
                        <td>Quarta</td>
                        <td>Quinta</td>
                        <td>Sexta</td>
                        <td>Sábado</td>
                    </tr>
                    <tr>
                        <td>Manhã</td>
                        <td><input type="checkbox" name="dom1" class="form-control" <?php if ($diaristaAtual['disponibilidade_domingo']{0} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="seg1" class="form-control" <?php if ($diaristaAtual['disponibilidade_segunda']{0} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="ter1" class="form-control" <?php if ($diaristaAtual['disponibilidade_terca']{0} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="qua1" class="form-control" <?php if ($diaristaAtual['disponibilidade_quarta']{0} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="qui1" class="form-control" <?php if ($diaristaAtual['disponibilidade_quinta']{0} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="sex1" class="form-control" <?php if ($diaristaAtual['disponibilidade_sexta']{0} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="sab1" class="form-control" <?php if ($diaristaAtual['disponibilidade_sabado']{0} == 1) echo "checked"; ?>/></td>
                    </tr>
                    <tr>
                        <td>Tarde</td>
                        <td><input type="checkbox" name="dom2" class="form-control" <?php if ($diaristaAtual['disponibilidade_domingo']{1} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="seg2" class="form-control" <?php if ($diaristaAtual['disponibilidade_segunda']{1} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="ter2" class="form-control" <?php if ($diaristaAtual['disponibilidade_terca']{1} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="qua2" class="form-control" <?php if ($diaristaAtual['disponibilidade_quarta']{1} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="qui2" class="form-control" <?php if ($diaristaAtual['disponibilidade_quinta']{1} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="sex2" class="form-control" <?php if ($diaristaAtual['disponibilidade_sexta']{1} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="sab2" class="form-control" <?php if ($diaristaAtual['disponibilidade_sabado']{1} == 1) echo "checked"; ?>/></td>
                    </tr>
                    <tr>
                        <td>Noite</td>
                        <td><input type="checkbox" name="dom3" class="form-control" <?php if ($diaristaAtual['disponibilidade_domingo']{2} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="seg3" class="form-control" <?php if ($diaristaAtual['disponibilidade_segunda']{2} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="ter3" class="form-control" <?php if ($diaristaAtual['disponibilidade_terca']{2} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="qua3" class="form-control" <?php if ($diaristaAtual['disponibilidade_quarta']{2} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="qui3" class="form-control" <?php if ($diaristaAtual['disponibilidade_quinta']{2} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="sex3" class="form-control" <?php if ($diaristaAtual['disponibilidade_sexta']{2} == 1) echo "checked"; ?>/></td>
                        <td><input type="checkbox" name="sab3" class="form-control" <?php if ($diaristaAtual['disponibilidade_sabado']{2} == 1) echo "checked"; ?>/></td>
                    </tr>
                </table>

                <br/>

                <p class="pull-right text-right">
                    <br/>
                    <button type="submit" class="btn btn-warning">Salvar</button>
                </p>

            </form>
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
