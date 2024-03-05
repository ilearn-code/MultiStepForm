<?php
require_once __DIR__ . "/../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Emailer
{
    public function sendEmail($subject, $body)
    {

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        // Configure the PHPMailer instance
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'ee8f233605ab9f';
        $mail->Password = '6c7fd5380bffb1';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;


        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;


        // Set the sender, recipient, subject, and body of the message


        $mail->setFrom('confirmation@hotel.com', 'Your Hotel');
        $mail->addAddress('me@gmail.com', 'Me');
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;


        return $mail->send();


    }
}








?>