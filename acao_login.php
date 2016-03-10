<?php

session_start();
include("acao_conexao.php");

$email = $_REQUEST['email'] or die;
$senha = md5($_REQUEST['senha']) or die;

if (isset($_REQUEST["relogin"])){
    $senha = $_REQUEST["senha"]; // já está md5
}

$sql = "select * from usuario where email='$email' and senha='$senha'";

$res = mysqli_query($bd, $sql);

if (mysqli_num_rows($res)){
    $_SESSION['usuario'] = mysqli_fetch_array($res);
    
    $id = $_SESSION['usuario']['id'];
    $sql = "select * from diarista where usuario=$id";
    $_SESSION['is_usuario_diarista'] = mysqli_num_rows(mysqli_query($bd, $sql));
    
    header("location: bemvindo.php");

} else{
    header("location: login.php?erro=1");
}

?>