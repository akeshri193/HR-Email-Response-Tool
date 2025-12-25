<?php
session_start();

session_start();
if (!isset($_SESSION["HR_logged_in"]) || !$_SESSION["HR_logged_in"]){
    header("Location: index.php");
    exit();
}

header('Content-Type: application/json');
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'akeshri193@gmail.com';
        $mail->Password   = 'ckdtbhzubyghfjis';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('akeshri193@gmail.com', 'HR Department');
        $mail->addAddress($data['email']);

        $mail->isHTML(false);
        $mail->Subject = $data['subject'];
        $mail->Body    = $data['message'];

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No data received']);
}}
catch (Exception $e) {
    print_r($e);
}
?>