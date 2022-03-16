<?php
session_start();
include_once('conexao.php');

$nmr_rastreio = $_POST['nmr_rastreio'];
$status = $_POST['status'];
$date = $_POST['date'];
$id_usr = $_SESSION['id_usuario'];

$sql_status = "SELECT * FROM status where id='$status'";
$dados_status = mysqli_query($conn,$sql_status) or die(mysqli_error($conn));
$linha_status = mysqli_fetch_assoc($dados_status);
$status = $linha_status['nome'];

$consulta_rastreio = "SELECT `id`, `numero_rastreio`, `status`, `data_criacao`, `id_usuario` FROM `rastreios` WHERE numero_rastreio = '$nmr_rastreio'";
$consuta = mysqli_query($conn,$consulta_rastreio) or die(mysqli_error($conn));
$linhas = mysqli_num_rows($consuta);
$dados = mysqli_fetch_array($consuta);

if($linhas == 0){
    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`,`auto_update`) VALUES ('$nmr_rastreio', '$status', '$date','$id_usr','1')";

    if (mysqli_query($conn, $sql_insert)){
        echo "<script>alert('Registro criado com sucesso!');</script>";
        echo "Redirecionando para pagina anterior...";
        header('Refresh: 1; URL=rastreios.php');
    } else {
        "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
    }
} else {
    if($dados['status'] != $status){
        $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `auto_update`) VALUES ('$nmr_rastreio', '$status', '$date','$id_usr','1')";
        if (mysqli_query($conn, $sql_insert)){
            echo "<script>alert('Registro criado com sucesso!');</script>";
            echo "Redirecionando para pagina anterior...";
            header('Refresh: 1; URL=rastreios.php');
        } else {
            "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }
    else{
        echo "<script>alert('Registro já presente na base!');</script>";
        echo "Redirecionando para pagina anterior...";
        header('Refresh: 1; URL=gerar_rastreio_basic.php');
    }
}

?>