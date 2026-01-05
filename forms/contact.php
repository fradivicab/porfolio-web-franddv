<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluimos autoload de Composer
require '../vendor/autoload.php'; // Ajusta la ruta según tu proyecto

// Receptor del email
$receiving_email_address = 'fradivicab@gmail.com';

// Datos del formulario
$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? 'Nuevo mensaje desde el formulario';
$message = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {
    // Configuración SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu-email@gmail.com'; // tu correo de Gmail
    $mail->Password   = 'gijy uhgw swox geum';    // tu App Password de Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
    $mail->Port       = 587;

    // Debug para ver detalle de conexión (en el navegador)
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {
        echo "Debug level $level; message: $str<br>";
    };

    // Remitente y destinatario
    $mail->setFrom($email, $name);
    $mail->addAddress($receiving_email_address);

    // Contenido del mensaje
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = nl2br($message);
    $mail->AltBody = $message;

    // Enviar email
    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "Error: No se pudo enviar el mensaje. {$mail->ErrorInfo}";
}
