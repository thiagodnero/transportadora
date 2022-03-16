<?php
require_once('conexao.php');
require '/home/u951970437/domains/fnlexpress.com.br/public_html/vendor/autoload.php'; //para uso dentro da hospedagem

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sql_select = "SELECT * FROM `rastreios` ORDER BY `rastreios`.`data_criacao` ASC";
$consulta = mysqli_query($conn, $sql_select) or die(mysqli_error($conn));
$linhas = mysqli_num_rows($consulta);

$data_arquivo = explode(' ', date('Y-m-d H:i:s'));
$arquivo = "logs_autoupdate/" . $data_arquivo[0] . '_atualizacao_automatica.log';

if (!file_exists($arquivo)) {
    $arquivo = fopen($arquivo, 'w');
    fwrite($arquivo, "\r\n");
    fwrite($arquivo, date('Y-m-d H:i:s') . " - Iniciando atualização automatica.");
    fwrite($arquivo, "\r\n");
    fwrite($arquivo, date('Y-m-d H:i:s') . " - Select realizado.");
    fwrite($arquivo, "\r\n");
    fwrite($arquivo, date('Y-m-d H:i:s') . " - Quantidade de linhas retornadas pela query: $linhas");
    fwrite($arquivo, "\r\n");
} else {
    $arquivo = fopen($arquivo, "a+");
    fwrite($arquivo, "\r\n");
    fwrite($arquivo, date('Y-m-d H:i:s') . " - Iniciando atualização automatica.");
    fwrite($arquivo, "\r\n");
    fwrite($arquivo, date('Y-m-d H:i:s') . " - Select realizado.");
    fwrite($arquivo, "\r\n");
    fwrite($arquivo, date('Y-m-d H:i:s') . " - Quantidade de linhas retornadas pela query: $linhas");
    fwrite($arquivo, "\r\n");
}

if ($linhas > 0) {
    while ($dados = mysqli_fetch_array($consulta)) {
        $id = $dados['id'];
        $nmr_rastreio = $dados['numero_rastreio'];
        $status = $dados['status'];
        $data = $dados['data_criacao'];
        $id_usr = $dados['id_usuario'];
        $email = $dados['email'];
        $auto_update = $dados['auto_update'];

        $sql_insert = "";
        $exec_query = false;
        fwrite($arquivo, "\r\n");
        fwrite($arquivo, date('Y-m-d H:i:s') . " - Iniando registro para rastreio: " . $nmr_rastreio . "ID: " . $id);
        fwrite($arquivo, "\r\n");

        $hoje = new DateTime();
        $hoje_string = $hoje->format('Y-m-d H:i:s');
        $datetime = new DateTime($data);
        $diff = $hoje->diff($datetime);
        $diff_string = $diff->format('%d');
        fwrite($arquivo, date('Y-m-d H:i:s') . " - Diferença de dias: " . $diff_string);
        fwrite($arquivo, "\r\n");

        if ($auto_update != 0) {
            switch ($diff_string) {
                case 0:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 0 Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    break;
                case 1:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 1 Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    break;
                case 2:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 2");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Objeto recebido na unidade de distribuição.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string', '$id_usr', '$email','0')";
                    break;
                case 3:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 3");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Objeto encaminhado para unidade regional de destino.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string', '$id_usr', '$email','0')";
                    break;
                case 4:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 4 Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    break;
                case 5:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 5 Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    break;
                case 6:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 6 Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    break;
                case 7:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 7 Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    break;
                case 8:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 8");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Objeto recebido na unidade regional de destino.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string', '$id_usr', '$email','0')";
                    break;
                case 9:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 9 Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    break;
                case 10:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 10");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Objeto aguardando rota de entrega.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string', '$id_usr', '$email','0')";
                    break;
                case 11:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 11");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Objeto em rota de entrega.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string', '$id_usr', '$email','0')";
                    break;
                case 12:
                    fwrite($arquivo, date('Y-m-d H:i:s') . "- Case 12");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Entrega não pode ser efetuada.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string', '$id_usr', '$email','0')";
                    break;
                case 13:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 13");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Objeto em rota de entrega.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string', '$id_usr', '$email','0')";
                    break;
                case 14:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Case 14");
                    fwrite($arquivo, "\r\n");
                    $exec_query = true;
                    $new_status = "Entrega não pode ser efetuada.";
                    $sql_insert = "INSERT INTO `rastreios` (`numero_rastreio`, `status`, `data_criacao`, `id_usuario`, `email`,`auto_update`) VALUES ('$nmr_rastreio', '$new_status', '$hoje_string, '$id_usr', '$email','0')";
                    break;
                default:
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - default Sem necessidade de atualização.");
                    fwrite($arquivo, "\r\n");
                    $sql_update = "";
                    break;
            }

            if ($exec_query) {
                fwrite($arquivo, date('Y-m-d H:i:s') . " - Iniciando chamada ao banco...");
                fwrite($arquivo, "\r\n");
                fwrite($arquivo, date('Y-m-d H:i:s') . " - Query: " . "$sql_insert");

                if (mysqli_query($conn, $sql_insert)) {
                    fwrite($arquivo, "\r\n");
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Rastreio $nmr_rastreio atualizado com sucesso.");
                    fwrite($arquivo, "\r\n");
                } else {
                    fwrite($arquivo, date('Y-m-d H:i:s') . " - Erro ao conectar ao banco...");
                    fwrite($arquivo, "\r\n");
                    "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
                }
            }

            if ($email != null) {
                $mail = new PHPMailer(true);
                try {
                    // Configurações do servidor
                    $mail->isSMTP();        //Devine o uso de SMTP no envio
                    $mail->SMTPAuth = true; //Habilita a autenticação SMTP
                    $mail->Username   = 'atendimento@fnlexpress.com.br';
                    $mail->Password   = 'Maconha123@';
                    // Criptografia do envio SSL também é aceito
                    $mail->SMTPSecure = 'tls';
                    // Informações específicadas pelo Google
                    $mail->Host = 'smtp.hostinger.com';
                    $mail->Port = 587;
                    // Define o remetente
                    $mail->setFrom('atendimento@fnlexpress.com.br', 'NO-REPLY');
                    // Define o destinatário
                    $mail->addAddress($email, '');
                    // Conteúdo da mensagem
                    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
                    $mail->Subject = 'Nova atualizacao de rastreio ' . $nmr_rastreio;
                    $mail->Body    = '<table><thead><tr><th>Data/Hora</th><th>Rastreio</th><th>Status</th></tr></thead><tbody><tr><td>' . $hoje_string . '</td><td>' . $nmr_rastreio . '</td><td>' . $new_status . '</td></tr></tbody></table>';
                    $mail->AltBody = 'Nova atualizacao de rastreio: ' . $new_status;
                    // Enviar
                    $mail->send();
                    echo 'A mensagem foi enviada!';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
    fclose($arquivo);
}
