<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {
        // $mail->isSMTP();
        // $mail->Host = 'mail.softvent.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'deekshith@softvent.com';
        // $mail->Password = 'deekshith@123';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 465;
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "deekshithkumar850@gmail.com";
        $mail->Password = "98@Deekshithk";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->isHTML(true);

        $mail->addAddress("kumardk8583@gmail.com");

        $subject = $_POST["txtSubject"];
        $fullName = $_POST["txtFullName"];
        $mobile = $_POST["txtMobile"];
        $email = $_POST["txtEmail"];
        $message = $_POST["txtMsg"];

        $body = "Name: $fullName <br/> Mobile No: $mobile <br /> Email: $email <br /> Message: $message";

        $mail->Subject = $subject + "Contact Details ";
        $mail->Body = $body;

       // Handle file attachment
        if ($_FILES["flupload"]["error"] == UPLOAD_ERR_OK) {
            $file_name = $_FILES["flupload"]["name"];
            $file_path = $_FILES["flupload"]["tmp_name"];
            $mail->addAttachment($file_path, $file_name);
        }

        $mail->send();

        echo "
        <script>
            alert('Sent successfully');
            document.location.href = 'index.html';
        </script>
        ";
    } catch (Exception $e) {
        echo "
        <script>
            alert('Error sending email: {$mail->ErrorInfo}');
            document.location.href = 'index.html';
        </script>
        ";
    }
}
?>
