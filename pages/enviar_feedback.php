<?php //ENVIANDO EMAIL UTILIZANDO A BIBLIOTECA PHPMAILER INSTALADA NO PROJETO 
    include_once("config.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    /* REQUIRES SUBSTITUÍDOS PELO AUTOLOAD
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    */

    require 'vendor/autoload.php';

    $status;

    //PREPARAÇÃO DO PHPMAILER
    $mail = new PHPMailer();
    $mail -> IsSMTP();
    $mail -> Mailer = "smtp";
    $mail -> SMTPDebug = 0;
    $mail -> SMTPAuth = TRUE;
    $mail -> SMTPSecure = 'tls';
    $mail -> Port = 587;
    $mail -> Host = 'smtp.gmail.com';
    $mail -> Username = "ifspvestibular@gmail.com";
    $mail -> Password = ""; //senha desabilitada
    $mail -> IsHTML(true);
    $mail -> AddAddress("ifspvestibular@gmail.com", "IFSP Vestibular");
    $mail -> SetFrom("ifspvestibular@gmail.com", "IFSP Vestibular");
    $mail -> AddReplyTo("ifspvestibular@gmail.com", "IFSP Vestibular");
    $mail -> Subject = $_POST['assunto'];
    $content = $_POST['msg'];

    $mail -> MsgHTML($content); 

    if(!$mail->Send()) {
        
        header('Location: feedback_status?status=erro');

        var_dump($mail);

    } else {

        header('Location: feedback_status?status=sucesso');

    }
?>
