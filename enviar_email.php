<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);
$nombres = $_GET['nombre'];
$correo = $_GET['email'];
$monto = $_GET['precio'];


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'tiendatigre.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'correopaypal@tiendatigre.com';                     //SMTP username
    $mail->Password   = 't-U==Lkp@*f[';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('correopaypal@tiendatigre.com', 'TIENDA TIGRE');
    $mail->addAddress($correo, $nombres);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Detalles de Compra';
    $cuerpo = '<h4>Gracias por su Compra>/h4>';
    $cuerpo = '<p>Su compra se ha realizado con exito </p> 
    <p>Detalles: </p>
    <p>Cliente: <b>'. $nombres .'</b></p>
    <p>Correo: <b>'. $correo .'</b></p>
    <p>Monto: <b>'. $monto .'</b></p>';

    $mail->Body    = utf8_decode($cuerpo);
    $mail->AltBody = 'Le enviamos los detalles de su compra.';

    $mail->setLanguage('es', '../PHPMailer/language/phpmailer.lang-es.php');

    $mail->send();
    header("Location: completado.html");
    exit();
} catch (Exception $e) {
    echo "Error al enviar el correo electronico: {$mail->ErrorInfo}";
}
