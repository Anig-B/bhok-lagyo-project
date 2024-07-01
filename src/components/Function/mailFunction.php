<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 function sendMail($email,$v_code,$subject,$body){
  require ("../../../PHPMailer/PHPMailer.php");
  require ("../../../PHPMailer/SMTP.php");
  require ("../../../PHPMailer/Exception.php");

  $mail = new PHPMailer(true);

  try {
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bhoklagyo90@gmail.com';                     //SMTP username
    $mail->Password   = 'ukneapeiwfmxkhrj';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bhoklagyo90@gmail.com', 'Bhok Lagyo');
    $mail->addAddress($email);     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
   return(true);
} catch (Exception $e) {
    return(false);
}
}
