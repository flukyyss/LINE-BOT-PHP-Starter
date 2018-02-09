<?php
$access_token = '7WCR1g4vUFAz1alqIcB7fM39A1rEymn5Q6HBm8UtUDNKjXaLggm1IBzxbhCf23whER9ml7RAmTUjElHzAPzBVtVwzfXjin25UzjsJKz75Tf2Uj2fA3n0F8vNHslZISji1Zq5ND2VgHBLJv+eRpPFvgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			if($text == 'hi' || $text == 'hello' || $text == 'หวัดดี' || $text == 'สวัสดี' || $text == 'ไง'){
				int a=rand(0,1);
				if(a=1){
					$messages = [
						'type' => 'text',
						'text' => 'สวัสดีคร๊าบ'
					];
				}
				else{
					$messages = [
						'type' => 'text',
						'text' => 'หวัดดีครับ'
				}
			}
			else{
				$messages = [
				'type' => 'text',
				'text' => 'ไม่เข้าใจคร้าบ'
			}

			
		}
		else if ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
	
			$messages = [
				'type' => 'sticker',
				"packageId" => "1",
				"stickerId" => "1"
			];
			
		}
			else if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
	
			$messages = [
				'type' => 'text',
				'text' => 'อัพโหลดสำเร็จ กรุณารอการตอบรับสักครู่'

			];
			
		}
		
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		
	}
}
echo "OK";