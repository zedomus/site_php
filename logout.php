<?php
session_start();

// Remove todas as variáveis de sessão
$_SESSION = array();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login login.php
header("Location: login.php");
exit();
?>
