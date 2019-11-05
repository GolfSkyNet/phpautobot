<?php

require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token
$channel_token = 'B5qap2QpWS3QLd19pOsh4FUhgNq7v5zhDtKrh4mLH/Lq0GWmCGJlZZ4SUfFwl7j2mdBQrdaC2EivgOGwUXQYCDeAH1L98XDOve0IWNWwUiiVYzZ9qFSXFUcDriOSISJ73QFfMS9jKz0M9WJqded67wdB04t89/1O/w1cDnyilFU=';
$channel_secret ='63219f8490cb174ce6fd928c5c188ca0';

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

    // Loop through each event
    foreach ($events['events'] as $event) {
    
        // Get replyToken
        $replyToken = $event['replyToken'];
        $ask = $event['message']['text'];
        switch(strtolower($ask)) {
            case 'm':
                $respMessage = 'What sup man. Go away!';
                break;
            case 'f':
                $respMessage = 'Love you lady.';
                break;
            default:
                $respMessage = 'What is your sex? M or F';
                break;    
        }
        
        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
        $textMessageBuilder = new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
    }
}
echo "OK";