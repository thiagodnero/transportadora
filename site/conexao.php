<?php
//Configuração de banco homologação
$host = 'db';
$user = 'root';
$pass = '465798';
$database = 'db_transportadora';

//Configuração de banco produção
//$host = 'localhost';
//$user = 'u951970437_joker';
//$pass = 'Go4s=gr5b$R=';
//$database = 'u951970437_dbtransp';
 
// Cria uma conexão
$conn = new mysqli($host,$user,$pass,$database);
 
//Altera o padrão de caracteres
//mysqli_set_charset($conn, "utf8");
 
// Verifica o status da conexão
if ($conn->connect_error) {
    die("A conexão com o banco de dados falhou: " . mysqli_connect_error($conn));
}
else{

}
?>