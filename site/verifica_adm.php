<?php
// Inicia sessões
session_start();


if ($_SESSION['admin'] != 1) {
    echo "<script>alert('Usuário não tem permissão para acessar área!');</script>";
    header("Location: portal.php");
    exit;
}
?>
