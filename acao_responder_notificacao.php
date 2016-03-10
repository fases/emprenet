<?php
session_start();
include("acao_conexao.php");

$idUsuarioDiarista = $_SESSION['usuario']['id'] or die;
$idNotificacao = $_GET['id'] or die;
$resposta = $_GET['resposta'] or die;

$sql = "update notificacao set diarista_aceitou=$resposta where id=$idNotificacao and diarista=$idUsuarioDiarista";
mysqli_query($bd, $sql);

header("location: ver_notificacoes.php");

?>