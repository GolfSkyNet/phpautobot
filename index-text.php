<?php
require_once('./vendor/autoload.php');

//Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = 'B5qap2QpWS3QLd19pOsh4FUhgNq7v5zhDtKrh4mLH/Lq0GWmCGJlZZ4SUfFwl7j2mdBQrdaC2EivgOGwUXQYCDeAH1L98XDOve0IWNWwUiiVYzZ9qFSXFUcDriOSISJ73QFfMS9jKz0M9WJqded67wdB04t89/1O/w1cDnyilFU=';
$channel_secret ='63219f8490cb174ce6fd928c5c188ca0';

//Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if(!is_null($events['events'])){

	//Loop through each event
	foreach($events['events']as $event){

		//Line API send a lot of event type, we interested in message only
		if($event['type'] == 'message'){

			switch ($event['message']['type']) {

				case 'text':

					//Get replyToken
					$replyToken = $event['replyToken'];

					//Reply message
					$respMessage ='Hello, Your message is '.$event['message']['text'];

					$httpClient = new CurlHTTPClient($channel_token);
					$bot = new LINEBot($httpClient, array('channelSecret'=>$channel_secret));

					$TextMessageBuilder = new TextMessageBuilder($respMessage);
					$response = $bot->replyMessage($replyToken, $TextMessageBuilder);
					
					break;
			}
		}
	}
}

echo "OK";