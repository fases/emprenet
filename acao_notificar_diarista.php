<?php
session_start();

include "acao_conexao.php";

$idUsuarioDiarista = $_GET['usuarioDiarista'] or null;
$cliente = $_SESSION['usuario'] or null;
$mensagem = addslashes($_GET['mensagem']) or "Olá, desejo contratá-lo!";

if (isset($cliente) && isset($idUsuarioDiarista)){
    $idCliente = $cliente['id'];
    
    $sql = "insert into notificacao (cliente, diarista, mensagem) values ($idCliente, $idUsuarioDiarista, '$mensagem');";
    
    if (mysqli_query($bd, $sql)){
        echo "<script>alert('Uma notificação foi enviada para o(a) diarista.'); window.location='login.php'; </script>";
    } else{
        echo("<p>Ocorreu algum erro e sua notificação não foi enviada.</p>");
    }
    
} else{
    header("location: login.php");
}

echo "<p>Você está sendo redirecionado. Clique <a href='login.php'>aqui</a> se estiver demorando demais.</p>";

?>