<?php
require 'SMTPMailer.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$content = $_POST['content'];

$response = [];
if(!$first_name){
    $response = [ "result"=> "bad", "message" => "Bạn chưa nhập danh xưng"];
} else if(!$last_name){
    $response = [ "result"=> "bad", "message" => "Bạn chưa nhập tên"];
} else if(!$email){
    $response = [ "result"=> "bad", "message" => "Bạn chưa nhập email"];
} else if(!$phone){
    $response = [ "result"=> "bad", "message" => "Bạn chưa nhập phone"];
}

if($response){
    echo json_encode($response);
} else {
	$first_name = $first_name == 1 ? 'Anh' : 'Chị';
    $body = 'Họ Tên: ' . $first_name . ' ' . $last_name . ' <br />
    Email: ' . $email . ' <br />
    Số điện thoại: ' . $phone;

    if($content){
        $body .= '<br /> Nội dung: ' . $content;
    }

    $mail = new SMTPMailer();
    
    $mail->Subject('Yêu cầu tư vấn Wifi con ong');
    $mail->Body($body);
        
    $data = $mail->Send() ? [ "result"=> "good"]  : [ "result"=> "bad", "message" => "Gửi không thành công."];      
    header('Content-Type: application/json');
    echo json_encode($data); 
}


