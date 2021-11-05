<?php

// Import PHPMailer classes into the global namespace. These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the location of your Composer autoload.php file.
require "vendor/autoload.php";

// Replace sender@example.com with your "From" address. This address must be verified with Amazon SES.
$sender="***";
$senderName="高中生點日記";

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp="***";

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp="***";

// If you're using Amazon SES in a region other than US West (Oregon), replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP endpoint in the appropriate region.
$host="***";
$port="***";

// The subject line of the email
$subject="點日記重設密碼";

// The plain-text body of the email
$bodyText="歡迎來到高中生點日記！你的驗證碼是：".$v_code."。請於 10 分鐘內輸入驗證碼，逾期將失效";
$mail=new PHPMailer(true);

try{
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username  =$usernameSmtp;
    $mail->Password  =$passwordSmtp;
    $mail->Host      =$host;
    $mail->Port      =$port;
    $mail->SMTPAuth  =true;
    $mail->SMTPSecure="tls";

    // Specify the message recipients.
    $mail->addAddress($_SESSION["username"]);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject   =$subject;
    $mail->Body      =$bodyText;
    $mail->Send();
    echo "Email sent!", PHP_EOL;

}catch(phpmailerException $e){
    echo "An error occurred.{$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
}catch(Exception $e) {
    echo "Email not sent.{$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}
?>
