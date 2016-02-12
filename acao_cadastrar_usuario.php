<?php
include("acao_conexao.php");

$nome = $_POST['nome'] or die;
$sobrenome = $_POST['sobrenome'] or die;
$email = $_POST['email'] or die;
$senha = md5($_POST['senha']) or die;
$senha2 = md5($_POST['senha2']) or die;
$uf = $_POST['uf'] or die;
$cidade = $_POST['cidade'] or die;
$endereco = $_POST['endereco'];

if ($senha != $senha2){
    die("Senhas diferentes. Tente novamente!");
}

if (!isset($endereco)){
    $endereco = "";
}


$sql = "insert into usuario (nome, sobrenome, email, senha, uf, cidade, endereco) values ('$nome', '$sobrenome', '$email', '$senha', '$uf', '$cidade', '$endereco')";


if (mysqli_query($bd, $sql)){
    header("location: acao_login.php?email=$email&senha=$senha&relogin=");
} else{
    die("Ocorreu algum erro. Tente novamente!");
}

?>