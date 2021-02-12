<?php

$str = $_GET['detail'];

$res = notify_message($str);
print_r($res);

header("Location: index.php");

function notify_message($message) {
    define('LINE_API',"https://notify-api.line.me/api/notify");
    $token = "aOwHEZYSaXmy03ZiAQU4b6iBuZV0H6onKlEoE7acowD";
    
    $queryData = array('message'=>$message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array(
        'http'=>array(
            'method'=>'POST',
            'header'=>"Content-Type: application/x-www-form-urlencoded\r\n" 
                        . "Authorization:  Bearer " . $token . "\r\n" 
                        . "Content-Length:" . strlen($queryData) . "\r\n",
            'content'=>$queryData
        ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API,FALSE,$context);
    $res = json_decode($result);
    return $res;
}
