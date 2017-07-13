<?php

function sendMail($to, $message, $subject)
{
    global $app;
    $mailsetting = unserialize(getSetting('mail'));
    if ($mailsetting != '' && $mailsetting['mailmode'] == 'smtp') {
        $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array($mailsetting['uname'] => $mailsetting['sender']))
                    ->setTo(array($to))
                    ->setBody($message, 'text/html');
        $app['mailer']->send($message);
    } elseif ($mailsetting['mailmode'] == 'phpmail') {
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

        // Additional headers
        $headers .= 'To: '.$to."\r\n";
        $headers .= 'From: '.$mailsetting['sender'].' <'.$mailsetting['uname'].'>'."\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);
    }
}

function sendMessage($mobile,$message){
    $url = 'http://smsapi.24x7sms.com/api_2.0/SendSMS.aspx?APIKEY=hdTb8Yd4woA&MobileNo='.$mobile.'&SenderID=TESTIN&Message='.$message.'&ServiceName=TEMPLATE_BASED';
		$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{\"EndUserIp\":\"182.71.129.241\",\"TokenId\":\"fb224fd2-fa68-4823-bf4a-1cd5d481f62b\",\"AdultCount\":\"1\",\"ChildCount\":\"0\",\"InfantCount\":\"0\",\"DirectFlight\":true,\"OneStopFlight\":false,\"JourneyType\":\"1\",\"PreferredAirlines\":null,\"Segments\":[{\"Origin\":\"MAA\",\"Destination\":\"BLR\",\"FlightCabinClass\":\"1\",\"PreferredDepartureTime\":\"2017-07-15T00:00:00\",\"PreferredArrivalTime\":\"2017-07-15T00:00:00\"}]}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: a7fd0fcd-2f92-7d51-5ce6-e94112f47061"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
		 
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
