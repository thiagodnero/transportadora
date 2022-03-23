<?php
session_start();
$login = $_SESSION['login'];
require_once('conexao.php');

$oldPassord = isset($_POST["oldPassword"]) ? md5(trim($_POST["oldPassword"])) : FALSE;
$newPassowrd = isset($_POST["newPassword"]) ? md5(trim($_POST["newPassword"])) : FALSE;
$newPassowrdConfirm = isset($_POST["newPasswordConfirm"]) ? md5(trim($_POST["newPasswordConfirm"])) : FALSE;

$SQL = "SELECT `id`, `login`, `senha`, `email`, `admin` FROM `usuarios` WHERE login = '$login';";
$result_id = @mysqli_query($conn, $SQL) or die("Erro no banco de dados!");
$total = @mysqli_num_rows($result_id);

if ($total) {
    $dados = @mysqli_fetch_array($result_id);

    if (!strcmp($oldPassord, $dados['senha'])) {

        $sql_update = "UPDATE `usuarios` SET `senha`= '$newPassowrdConfirm' WHERE `login`= '$login'";
        if ($conn->query($sql_update) == true) {
            echo "<script>alert('Senha alterada com sucesso. \\nPor segurança, realize novamente o login.');</script>";
            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
            header('Refresh: 0; URL=index.html');
        } else {
            echo '<script>alert("Não foi possivel alterar a senha.")</script>';
            header('Refresh: 0; URL=portal.php');
        }
    } else {
        echo "<script>alert('Senha atual incorreta.');</script>";
        header('Refresh: 0; URL=portal.php');
    }
} else {
    echo '<script>alert("Erro inesperado.")</script>';
    header('Refresh: 0; URL=portal.php');
}
