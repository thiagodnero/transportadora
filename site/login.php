<?php
session_start();
require_once('conexao.php');

$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

if(!$login || !$senha){
    echo '<script>alert("Login ou senha vazio.")</script>';
    echo '<script>window.location="index.html";</script>';
    exit;
}

$SQL = "SELECT `id`, `login`, `senha`, `email`, `admin` FROM `usuarios` WHERE login = '$login';";
$result_id = @mysqli_query($conn,$SQL) or die("Erro no banco de dados!");
$total = @mysqli_num_rows($result_id);

if($total){
    $dados = @mysqli_fetch_array($result_id);

    if(!strcmp($senha,$dados["senha"])){
        $_SESSION["id_usuario"] = $dados["id"];
        $_SESSION["login"] = $dados["login"];
        $_SESSION["admin"] = $dados["admin"];
        header("location: portal.php");
        exit;
    } else{
        echo '<script>alert("Senha invalida.")</script>';
        echo '<script>window.location="index.html";</script>';
        exit;
    }
} else{
    echo '<script>alert("Usuario não encontrado.")</script>';
    echo '<script>window.location="index.html";</script>';
    exit;
}

?>