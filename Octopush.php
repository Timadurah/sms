<?php




$BASE_URL = $_POST['urly'];
$API_KEY = $_POST['api'];
$SENDERID = $_POST['from'];
$RECEIVERs = $_POST['to'];
$CONTENT = $_POST['info__'];

$i = count($RECEIVERs);
$error_sms = 0;
$successfull_sms = 0;
foreach ($RECEIVERs as $RECEIVER) {



    $SENDER = $SENDERID;
    $RECIPIENT = $RECEIVER;
    $MESSAGE_TEXT = $CONTENT;

    $payload = [
        'recipients' => [
            [
                'phone_number' => '+'.$RECEIVER.'',
                'param1' => '.'
            ],
        ],
        'text' => ''.$CONTENT.'{param1}',
        'type' => 'sms_premium',
        'purpose' => 'wholesale',
        'sender' => ''.$SENDER.'',
        'send_at' => '2020-10-03T07:42:39-07:00',
        'with_replies' => false,
    ];

    /*
{
    "recipients":[{"phone_number":"+33600000000","param1":"John"}],
    "text":"Hello {param1}. STOP au XXXXX",
    "type":"sms_premium",
    "purpose":"wholesale",
    "sender":"SMS",
    "send_at":"2020-10-03T07:42:39-07:00",
    "with_replies":false
}
key uHeRgtVZhi0poO5jUQnABKyIE1vWDX8S
mail: durallite@gmail.com
https://api.octopush.com/v1/public/sms-campaign/send
 */
    $jsonEncodedPayload = json_encode($payload);

    $curl = curl_init();

    curl_setopt_array(
        $curl,
        [
            CURLOPT_URL => $BASE_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonEncodedPayload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'api-key: '.$API_KEY.'',
                'api-login:  '.$SENDERID.'',
                'cache-control: no-cache'
            ],
        ]
    );

    $myfile = fopen("ReportLog.txt", "a") or die("Unable to open file!");
    $txt = date("h:i:sa") . ' Report\r\n';
    fwrite($myfile, $txt);


    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        fwrite($myfile, $err);
        $error_sms++;
    } else {
        // {"sms_ticket":"sms_5f6c4ba715694","number_of_contacts":1,"total_cost":0.062}
        fwrite($myfile, $response);
        $successfull_sms++;
    }
}



echo ' <span class="d-flex text-success m-2">' . $successfull_sms . ' of ' . $i . ' Successfully send</span>
<span class="d-flex text-danger m-2">' . $error_sms . ' of ' . $i . ' fail to send</span>
<a href="./ReportLog.txt">
<button type="button" class="btn btn-outline-secondary">Check Log</button></a>';
