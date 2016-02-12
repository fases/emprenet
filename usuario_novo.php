<?php
$isDiarista = isset($_GET["diarista"]);
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
                                <li class="active"><a href="index.php">Início</a></li>
                                <li><a href="#">Quem somos</a></li>
                                <li><a href="login.php">Acessar conta</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>


        <div class="container">
            <form class="painel-centralizado" method="post" action="<?php echo $isDiarista ? 'acao_iniciar_cadastro_diarista.php' : 'acao_cadastrar_usuario.php'; ?>">
                <h1>Novo usuário</h1>

                <strong>Nome:</strong>
                <input type="text" class="form-control" placeholder="Fulano" name="nome" required/>
                <strong>Sobrenome:</strong>
                <input type="text" class="form-control" placeholder="da Silva" name="sobrenome" required/>
                <strong>E-mail:</strong>
                <input type="email" class="form-control" placeholder="fulano@servico.com" name="email" required/>
                <strong>Senha:</strong>
                <input type="password" class="form-control" placeholder="Senha" name="senha" required/>
                <input type="password" class="form-control" placeholder="Repita a senha" name="senha2" required/>
                <strong>Estado:</strong>
                <select class="form-control" name="uf">
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
                <strong>Cidade:</strong>
                <input type="text" class="form-control" placeholder="Sua cidade" name="cidade" required/>
                <span>Endereço:</span>
                <input type="text" class="form-control" placeholder="Rua Brusque, n 666" name="endereco"/>

                <p class="pull-right text-right">
                    <br/>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
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
