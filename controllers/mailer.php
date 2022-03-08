<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function enviarEmail($emailDestino, $nomeDestino)
{
    include 'email.php';
    require 'config.php';
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $servicoEmail;
        $mail->Password = $servicoSenha;
        $mail->Port = 587;
    
        $mail->setFrom($emailCliente);
        $mail->addAddress($emailDestino);
    
        $mail->isHTML(true);
        $mail->Subject = $nomeCliente;
        $mail->Body = $corpoEmail;
        
        if($mail->send()) {
            echo 'Email enviado com sucesso';
        } else {
            echo 'Email nao enviado';
        }
        header('Location: index.php');
        die();
    } catch (Exception $e) {
        echo "A mensagem não foi enviada. Erro: {$mail->ErrorInfo}";
    }
}
