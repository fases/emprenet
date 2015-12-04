<html>

<head>
<title>cadastro!!</title>
</head>

<body>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "cadastro";
$conexao = mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($banco) or die (mysql_error());
?>
<?php
$nome=$_POST['nome'];
$email=$_POST['email'];
$confirmaremail=$_POST['confirmaremail'];
$logradouro=$_POST['logradouro'];
$bairro=$_POST['bairro'];
$cidade=$_POST['cidade'];
$uf=$_POST['uf'];
$cpf=$_POST['cpf'];
$celular=$_POST['celular'];
$usuario=$_POST['usuario'];
$senha=$_POST['senha'];
$confirmarsenha=$_POST['confirmarsenha'];
$sql = mysql_query("INSERT INTO usuarios(nome, email, confirmaremail, logradouro, bairro, cidade, uf, cpf, celular, usuario, senha, confirmarsenha)
VALUES('$nome', '$email', '$confirmaremail', '$logradouro', '$bairro', '$cidade', '$uf', '$cpf', '$celular', '$usuario', '$senha', '$confirmarsenha')");
?>
echo("Cadastro efetuado com sucesso!");
</body>
</html>
