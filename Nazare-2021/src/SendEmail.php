<?php

// Load Composer's autoloader
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class SendEmail{
        public static function send($nome,$email,$celular,$palestrante)
        {
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->CharSet = 'UTF-8';
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = '';                     // SMTP username
                $mail->Password   = '';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('paulllo.v.m.s@gmail.com', 'Festa Cultural de Nazaré');
                $mail->addAddress('oliviorafael@hotmail.com', 'Festa Cultural de Nazaré');
                
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Opa, alguém que se inscrever na oficina do '.$palestrante;
                $mail->Body    = '<p>- Nome: '.$nome.'</p>
                                  <p>- E-mail: '.$email.'</p>
                                  <p>- Celular: '.$celular.' </p> 
                                  <h2>Para a oficina do '.$palestrante.'</h2>';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header("Location: oficinas.php?url=mensagem-enviada");
            } catch (Exception $e) {
                header("Location: oficinas.php?url=erro-enviar-mensagem");
            }
        }
    }