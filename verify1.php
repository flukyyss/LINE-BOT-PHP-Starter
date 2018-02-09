<?php
$access_token = '7WCR1g4vUFAz1alqIcB7fM39A1rEymn5Q6HBm8UtUDNKjXaLggm1IBzxbhCf23whER9ml7RAmTUjElHzAPzBVtVwzfXjin25UzjsJKz75Tf2Uj2fA3n0F8vNHslZISji1Zq5ND2VgHBLJv+eRpPFvgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
