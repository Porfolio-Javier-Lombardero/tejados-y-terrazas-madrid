<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '/home/o235664/phpmailer/PHPMailer-master/src/PHPMailer.php';
require_once '/home/o235664/phpmailer/PHPMailer-master/src/SMTP.php';
require_once '/home/o235664/phpmailer/PHPMailer-master/src/Exception.php';


// Configuración de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tejadosyterrazasmadrid@gmail.com';
    $mail->Password = 'szsq scsi yeko mywc'; // La contraseña de aplicación generada
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    // Configuración del correo
    $mail->addAddress('tejadosyterrazasmadrid@gmail.com', 'Tejados y Terrazas Madrid');
     $mail->setFrom('tejadosyterrazasmadrid@gmail.com', 'Tejados y Terrazas Madrid');
     $mail->addReplyTo('tejadosyterrazasmadrid@gmail.com', 'Tejados y Terrazas Madrid');
     $mail->Subject = 'NUEVA SOLICITUD DE PRESUPUESTO! desde formulario web tejadosyterrazasmadrid.com';

    // Cuerpo del mensaje
    $mail->Body = "DATOS DEL CLIENTE:\n\n".
                  "Nombre: $nombre\n".
                  "Email: $email\n".
                  "Teléfono: $telefono\n".
                  "Mensaje: $mensaje\n";

    // Manejo del archivo adjunto
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        $mail->addAttachment($fileTmpPath, $fileName);
    }

    // Enviar el correo
    if (empty($mail->getToAddresses())) {
    die("Error: No se ha podido establecer el destinatario.");
}

if (!$mail->send()) {
    echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
} else {
    echo "Mensaje enviado correctamente. Pronto nos pondremos en contacto con usted.";
}

} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>
