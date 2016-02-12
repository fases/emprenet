<?php
session_start();
include("acao_conexao.php");

$usuarioId = $_SESSION['usuario']['id'];

$categoria = $_POST['categoria'] or die;
$preco = $_POST['preco'] or die;
$sobre = $_POST['sobre'];
$disponivel = isset($_POST['disponivel']) ? "1" : "0";
$dom1 = isset($_POST['dom1']) ? "1" : "0";
$dom2 = isset($_POST['dom2']) ? "1" : "0";
$dom3 = isset($_POST['dom3']) ? "1" : "0";
$dom = $dom1 . $dom2 . $dom3;
$seg1 = isset($_POST['seg1']) ? "1" : "0";
$seg2 = isset($_POST['seg2']) ? "1" : "0";
$seg3 = isset($_POST['seg3']) ? "1" : "0";
$seg = $seg1 . $seg2 . $seg3;
$ter1 = isset($_POST['ter1']) ? "1" : "0";
$ter2 = isset($_POST['ter2']) ? "1" : "0";
$ter3 = isset($_POST['ter3']) ? "1" : "0";
$ter = $ter1 . $ter2 . $ter3;
$qua1 = isset($_POST['qua1']) ? "1" : "0";
$qua2 = isset($_POST['qua2']) ? "1" : "0";
$qua3 = isset($_POST['qua3']) ? "1" : "0";
$qua = $qua1 . $qua2 . $qua3;
$qui1 = isset($_POST['qui1']) ? "1" : "0";
$qui2 = isset($_POST['qui2']) ? "1" : "0";
$qui3 = isset($_POST['qui3']) ? "1" : "0";
$qui = $qui1 . $qui2 . $qui3;
$sex1 = isset($_POST['sex1']) ? "1" : "0";
$sex2 = isset($_POST['sex2']) ? "1" : "0";
$sex3 = isset($_POST['sex3']) ? "1" : "0";
$sex = $sex1 . $sex2 . $sex3;
$sab1 = isset($_POST['sab1']) ? "1" : "0";
$sab2 = isset($_POST['sab2']) ? "1" : "0";
$sab3 = isset($_POST['sab3']) ? "1" : "0";
$sab = $sab1 . $sab2 . $sab3;


$sql = "update diarista set categoria=$categoria, preco_por_hora=$preco, sobre='$sobre', aceitando_trabalho=$disponivel, disponibilidade_segunda='$seg', disponibilidade_terca='$ter', disponibilidade_quarta='$qua', disponibilidade_quinta='$qui', disponibilidade_sexta='$sex', disponibilidade_sabado='$sab', disponibilidade_domingo='$dom' where usuario=$usuarioId";

if (mysqli_query($bd, $sql)){
    header("location: bemvindo.php");
} else{
    die("Ocorreu algum erro. Tente novamente!");
}





?>