<?php

$bd = mysqli_connect("localhost", "root", "");

if (!$bd) { 
    die("Falha ao tentar acessar banco de dados."); 
} else { 
    if (!mysqli_select_db($bd, "bd_emprenet")) { 
        die("Erro ao tentar selecionar banco de dados"); 
    } 
} 
