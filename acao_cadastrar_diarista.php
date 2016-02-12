<?php
session_start();
include("acao_conexao.php");

$nome = $_SESSION['CADASTRO_INICIADO']['nome'] or die;
$sobrenome = $_SESSION['CADASTRO_INICIADO']['sobrenome'] or die;
$email = $_SESSION['CADASTRO_INICIADO']['email'] or die;
$senha = $_SESSION['CADASTRO_INICIADO']['senha'] or die; // em md5
$uf = $_SESSION['CADASTRO_INICIADO']['uf'] or die;
$cidade = $_SESSION['CADASTRO_INICIADO']['cidade'] or die;
$endereco = $_SESSION['CADASTRO_INICIADO']['endereco'] or die;

$sqlUsuario = "insert into usuario (nome, sobrenome, email, senha, uf, cidade, endereco) values ('$nome', '$sobrenome', '$email', '$senha', '$uf', '$cidade', '$endereco')";


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

if (mysqli_query($bd, $sqlUsuario)){
    $usuario = mysqli_insert_id($bd);

    $sqlDiarista = "insert into diarista (usuario, categoria, preco_por_hora, sobre, aceitando_trabalho, disponibilidade_segunda, disponibilidade_terca, disponibilidade_quarta, disponibilidade_quinta, disponibilidade_sexta, disponibilidade_sabado, disponibilidade_domingo) values ($usuario, $categoria, $preco, '$sobre', $disponivel, '$seg', '$ter', '$qua', '$qui', '$sex', '$sab', '$dom')";

    if (mysqli_query($bd, $sqlDiarista)){
        unset($_SESSION['CADASTRO_INICIADO']);
        header("location: acao_login.php?email=$email&senha=$senha&relogin=");
    } else{
        $sqlDesfazerUsuario = "delete from usuario where id=$usuario";
        mysqli_query($bd, $sqlDesfazerUsuario);
        die("Ocorreu algum erro nos dados de diarista. Tente novamente!");
    }

} else{
    die("Ocorreu algum erro nos dados iniciais do usuário. Refaça todo o cadastro novamente!");
}

?>