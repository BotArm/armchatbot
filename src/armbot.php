<?php
require_once __DIR__ . '/../vendor/autoload.php';

$token = 'QFW5zx4qTkWfWsQKNlaOf5lDCgFTNt+wKV8rw5P/8UlQxbOqNarlInIwuoEcNqgwiJhZTHen75QixKLah1ttM+Ms6snrxNSPcYV+284HLUEEbflnJuN5xHBCsvsOjaqXyoCW3lHu8uWgMwzL5pgPjAdB04t89/1O/w1cDnyilFU=' ;
$secret = '255befc1f82d6539c481e5f593e92517' ;

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);

$entityBody = file_get_contents('php://input');
$data = json_decode($entityBody, true);

foreach ($data['events'] as $event) {
	$buttonTemplate = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("คุณเคยสมัครแล้วหรือยัง", 
		[{
            "type" => "message",
            "label" => "Yes",
            "text"=> "เคยสมัครแล้ว"
        },
        {
            "type" => "message",
            "label" => "No",
            "text" => "ยังไม่เคยสมัคร"
        }
        ]) ;
	$MessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('this is a confirm template', $buttonTemplate);
	$response = $bot->replyMessage($event['replyToken'], $MessageBuilder);  
}
