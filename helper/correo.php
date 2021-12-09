<?php
use PHPMailer\PHPMailer\PHPMailer;
require "vendor/autoload.php";

class Correo{
    public static function enviarCorreo($email, $idUsusario){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;

        $mail->Username = "************";
        $mail->Password = '************';

        $mail->Subject = "Examinator";
        $mail->CharSet = 'UTF-8';

        $mail->AddEmbeddedImage('img/logo.png', 'logo');

        $mail->MsgHTML("
        <div align='center'>
            <img src='cid:logo'>
            <h3 align='center'>Bienvenido/a a nuestra web de test online EXAMINATOR</h3>
            <p>¡Su cuenta ha sido creada con éxito!</p>
            <p>Para poder comenzar debe activar su cuenta presionando en el enlace que le proporcionamos a continuación.</p>
            <p><a href='http://localhost/PROYECTO/PROYECTO_Examinator/activarCuenta.php?idAlta=$idUsusario&email=$email'>Activar cuenta de usuario</a></p>
            <p>¡Gracias por confiar en nosotros!</p>
        </div>");

        $address = $email;
        $mail->AddAddress($address, "Alumno");

        $mail->Send();
    }
}