<?php
session_start();
include("acao_conexao.php");

$usuarioAtual = $_SESSION['usuario'];

$nome = $usuarioAtual['nome'] or die;
$sobrenome = $usuarioAtual['sobrenome'] or die;
$email = $usuarioAtual['email'] or die;
$senha = $usuarioAtual['senha'] or die;

$senhaDigitada = md5($_POST['senha']) or die;
$senha1 = md5($_POST['senha1']) or die;
$senha2 = md5($_POST['senha2']) or die;
$uf = $_POST['uf'] or die;
$cidade = $_POST['cidade'] or die;
$endereco = $_POST['endereco'];

if ($senha1 != $senha2 || $senha != $senhaDigitada){
    die("Senhas diferentes. Tente novamente!");
}

$sql = "update usuario set senha='$senha1', uf='$uf', cidade='$cidade', endereco='$endereco' where email='$email' and senha='$senhaDigitada'";

if (mysqli_query($bd, $sql)){
    if (isset($senha1) && $senha1 != ""){
        $senha = $senha1;
    } else{
        $senha = $senhaDigitada;
    }
    
    header("location: acao_login.php?email=$email&senha=$senha&relogin=");
} else{
    die("Ocorreu algum erro. Tente novamente!");
}

?>