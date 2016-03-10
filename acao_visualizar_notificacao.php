<?php
session_start();
include("acao_conexao.php");

$idUsuarioCliente = $_SESSION['usuario']['id'] or die;
$idNotificacao = $_GET['id'] or die;

$sql = "update notificacao set cliente_ok=1 where id=$idNotificacao and cliente=$idUsuarioCliente";
mysqli_query($bd, $sql);

$sql = "select * from notificacao where id=$idNotificacao";
$notificacao = mysqli_fetch_array(mysqli_query($bd, $sql));

if ($notificacao){
    header("location: usuario.php?id=".$notificacao['diarista']);
} else{
    header("location: ver_notificacoes.php");
}
?>