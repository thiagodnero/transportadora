<?php
require_once 'conexao.php';

if (isset($_POST['id_rastreio'])) {
    $resultado = '';
    $sql_select = "SELECT `id`, `numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email` FROM `rastreios` WHERE `numero_rastreio`= '" . $_POST['id_rastreio'] . "'";

    $consulta = mysqli_query($conn, $sql_select) or die(mysqli_error($conn));
    
        while ($dados = mysqli_fetch_array($consulta)) {            
            $resultado .= '<tr>';
            $resultado .= '<td>' . $dados['status'] . '</td>';
            $resultado .= '<td>' . $dados['data_criacao'] . '</td>';
            $resultado .= '</tr>';            
        }
        echo $resultado;
}
