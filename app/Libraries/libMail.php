<?php 
namespace App\Libraries;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class libMail {
    public static function sendMail($html, $emailClient = ""){
        //Load Composer's autoloader
        require ROOTPATH . 'vendor/autoload.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try{
            // $mail->SMTPDebug = 2;
            $mail->SMTPDebug = 0;
            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            
            $mail->Username = 'trabajosifp@gmail.com';
            $mail->Password = 'raulcarlosgeo';

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->AddAddress("raulblazquezhernangomez@gmail.com");

            if($emailClient != "")
            $mail->AddAddress($emailClient);
            
            $mail->SetFrom('trabajosifp@gmail.com');
            $mail->Subject = "Comentario en la web de ";
            $content = $html;
            // $content = "<b>Email de: <br> Tel: . <br> Texto: </b>";

            $mail->MsgHTML($content); 
            $mail->send();
        }catch(Exception $e){
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
} 