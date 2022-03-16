<?php 
session_start();
include_once('conexao.php');

$login = $_POST['login'];
$senha = md5($_POST['senha']);
$email = $_POST['email'];
$adm = $_POST['adm'];

$adm = $adm == null ? 0 : 1;

$sql_insert = "INSERT INTO `usuarios`(`login`, `senha`, `email`, `admin`) VALUES ('$login','$senha','$email','$adm')";

if(mysqli_query($conn,$sql_insert)){
    echo "<script>alert('Registro criado com sucesso!');</script>";
    header('Refresh: 0.5; URL=../portal/administracao.php');
} else{
    "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
}

?>