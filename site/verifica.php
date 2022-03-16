<?php
session_start();

if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["login"])){
header("Location: index.html");
exit;
}
?>