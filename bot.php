<?php
$access_token = 'Tw3Q8ZD5sM0v64J4d4EA3xIPhHuomz+dZu0fFIAkBqVfwmy/hmF7bx2EPmQGpRrPdzy1+Sjfpi8GLpXV2kIixMC0Pl4yIKq2tqGVSFLns90PL76EB2+PO0FDvN9CNECtu6exP6jOjy9PgiF92TmmngdB04t89/1O/w1cDnyilFU=';

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
			
			$typs = $text;
			
			switch($text){
				case "hi" : $text = "สวัสดีครับ ยินดีต้อนรับ พิมพ์ 1  เลือกโปรโมชั่น พิมพ์  2  รับส่วนลด"; break;
				case "1" : $text = "โปรโมชั่น".date("d m Y"); break;
				case "2" : $text = "ส่วนลดของเดือน".date("m Y"); break;
				default : $text = $text." Reply by Piak"; break;
			}
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			if($typs==1){				
				// Build message to reply back
				$messages = [
					'type' 		=> 'location',
					'title'		=> 'My Location',
					'address'	=> 'Bangkok, Thailand',
					'latitude'	=> '35.65910807942215',
					'longitude' 	=> '139.70372892916203'
				];

			}else{
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text
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

			echo $result . " \r\n";
		}
	}
}
echo "OK";
