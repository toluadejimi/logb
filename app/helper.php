<?php

function send_notify($message){

    $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.telegram.org/bot6140179825:AAGfAmHK6JQTLegsdpnaklnhBZ4qA1m2c64/sendMessage?chat_id=1316552414',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'chat_id' => "1316552414",
        'text' => $message,

    ),
    CURLOPT_HTTPHEADER => array(),
));

$var = curl_exec($curl);
curl_close($curl);

$var = json_decode($var);

}
