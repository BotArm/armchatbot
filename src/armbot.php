<?php
require_once __DIR__ . '/../vendor/autoload.php';

use LINE\LINEBot\MessageBuilder\TextMessageBuilder ;
use LINE\LINEBot\MessageBuilder\TemplateActionBuilder\MessageTemplateActionBuilder ;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder ;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder ;

$token = 'QFW5zx4qTkWfWsQKNlaOf5lDCgFTNt+wKV8rw5P/8UlQxbOqNarlInIwuoEcNqgwiJhZTHen75QixKLah1ttM+Ms6snrxNSPcYV+284HLUEEbflnJuN5xHBCsvsOjaqXyoCW3lHu8uWgMwzL5pgPjAdB04t89/1O/w1cDnyilFU=' ;
$secret = '255befc1f82d6539c481e5f593e92517' ;

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);

$body = file_get_contents('php://input');
$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

$data = $bot->parseEventRequest($body, $signature);

foreach ($data as $event) {
	//$yes = new \LINE\LINEBot\MessageBuilder\TemplateActionBuilder\MessageTemplateActionBuilder('yes','เคยสมัครแล้ว') ;
	//$no = new \LINE\LINEBot\MessageBuilder\TemplateActionBuilder\MessageTemplateActionBuilder("no","ยังไม่เคยสมัคร") ;

	/*$buttonTemplate = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder('คุณเคยสมัครแล้วหรือยัง', $yes );
	$MessageBuilder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('this is a confirm template', $buttonTemplate ) ;*/
	//$response = $bot->replyMessage($event['replyToken'], $MessageBuilder);  

	$reply_token = $event->getReplyToken();
	//$MessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello its me');
	$response = $bot->replyMessage( $reply_token , 
                    new TemplateMessageBuilder(
                        'Confirm alt text',
                        new ConfirmTemplateBuilder('Do it?', [
                            new MessageTemplateActionBuilder('Yes', 'Yes!'),
                            new MessageTemplateActionBuilder('No', 'No!'),
                        ])
                    ));  
}
 

