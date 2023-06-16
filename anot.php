<?php

/**
 * Send an SMS message by using Infobip API PHP Client.
 *
 * For your convenience, environment variables are already pre-populated with your account data
 * like authentication, base URL and phone number.
 *
 * Please find detailed information in the readme file.
 */



$API_KEY = "6d2830be610ce096a9f4fff78ef8c107-f3d0c4e1-c71a-4972-98a0-52e7b1ab6613";
$SENDERID = $_POST['from'];
$RECEIVERs = $_POST['to'];
$CONTENT = $_POST['info__'];


foreach ($RECEIVERs as $RECEIVER) {
  

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://xrzp6l.api.infobip.com/sms/2/text/advanced',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"messages":[{"destinations":[{"to":"2347026626851"}],"from":"InfoSMS","text":"This is a sample message"}]}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: 05decd30c18afb071fb214353fd21429-b31eff72-657c-4467-96a2-4d3094a4de93',
            'Content-Type: application/json',
            'Accept: application/json'
        ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    
    




    // 
}