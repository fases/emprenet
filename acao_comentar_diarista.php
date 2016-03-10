<?php
session_start();
include("acao_conexao.php");

$clienteAutor = $_SESSION['usuario']['id'] or die;
$diarista = $_POST['diarista'] or die;
$avaliacao = $_POST['avaliacao'] or die;
$detalhes = $_POST['detalhes'] or die;
$detalhes = addslashes($detalhes); // evita bugar sql com aspas

$sql = "insert into comentario (cliente_autor, diarista, avaliacao, detalhes) values ($clienteAutor, $diarista, $avaliacao, '$detalhes')";
mysqli_query($bd, $sql);

header("location: usuario.php?id=$diarista");

?>