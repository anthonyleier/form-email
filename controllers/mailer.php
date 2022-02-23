<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function enviarEmail($emailDestino, $nomeDestino)
{
    require 'config.php';
    $mail = new PHPMailer(true);
    $corpoEmail = file_get_contents('templateEmail.php');

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $emailCliente;
        $mail->Password = $senhaCliente;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($emailCliente, $nomeCliente);
        $mail->addAddress($emailDestino, $nomeDestino);

        $mail->isHTML(true);
        $mail->Subject = 'Mensagem da Empresa'; // Assunto personalizável do cliente
        $mail->Body = $corpoEmail;
        $mail->AltBody = $corpoEmail;

        $mail->send();

        header("Location: index.php");
        die();
    } catch (Exception $e) {
        echo "A mensagem não foi enviada. Erro: {$mail->ErrorInfo}";
    }
}
