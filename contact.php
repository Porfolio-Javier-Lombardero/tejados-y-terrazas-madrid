<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../phpmailer/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../phpmailer/PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../phpmailer/PHPMailer-master/src/Exception.php';

// Configuración de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'tejadosyterrazasmadrid@gmail.com'; // Tu correo de Gmail
    $mail->Password = 'szsq scsi yeko mywc'; // La contraseña de aplicación generada
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; 

    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    // Configuración del correo
    $mail->setFrom($email, $nombre . ' ' . $apellidos);
    $mail->addAddress('tejadosyterrazasmadrid@gmail.com', 'Tejados y Terrazas Madrid'); // Destinatario
    $mail->Subject = 'NUEVA SOLICITUD DE PRESUPUESTO! formulario  web tejadosyterrazasmadrid.com';

    // Cuerpo del mensaje
    $mail->Body = "Has recibido un nuevo mensaje:\n\n".
                  "Nombre: $nombre\n".
                  "Apellidos: $apellidos\n".
                  "Email: $email\n".
                  "Teléfono: $telefono\n".
                  "Mensaje: $mensaje\n";

    // Adjuntar archivo si se seleccionó
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Asegúrate de que el archivo existe
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];

        // Adjuntar el archivo
        $mail->addAttachment($fileTmpPath, $fileName);
    }

    // Enviar el correo
    if ($mail->send()) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }

} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>


