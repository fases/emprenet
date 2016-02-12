<?php
session_start();
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

$_SESSION['CADASTRO_INICIADO'] = [
    'nome' => $nome,
    'sobrenome' => $sobrenome,
    'email' => $email,
    'senha' => $senha,
    'uf' => $uf,
    'cidade' => $cidade,
    'endereco' => $endereco
];

header("location: diarista_novo.php");

?>