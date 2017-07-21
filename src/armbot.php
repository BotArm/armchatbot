<?php
require_once __DIR__ . '/../vendor/autoload.php';

use LINE\LINEBot\MessageBuilder\TextMessageBuilder ;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder ;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder ;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder ;

$token = 'QFW5zx4qTkWfWsQKNlaOf5lDCgFTNt+wKV8rw5P/8UlQxbOqNarlInIwuoEcNqgwiJhZTHen75QixKLah1ttM+Ms6snrxNSPcYV+284HLUEEbflnJuN5xHBCsvsOjaqXyoCW3lHu8uWgMwzL5pgPjAdB04t89/1O/w1cDnyilFU=' ;
$secret = '255befc1f82d6539c481e5f593e92517' ;

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);

$body = file_get_contents('php://input');
$events = json_decode($body, true);

foreach ($events['events'] as $event) {
	$msg = $event['message']['text'] ;

	switch ($msg) {
    case 'เริ่ม':
        $MessageBuilder = new TemplateMessageBuilder('ทดสอบ', new ConfirmTemplateBuilder('คุณเคยสมัครแล้วหรือยัง', 
		[ new MessageTemplateActionBuilder('เคยสมัครแล้ว', 'เคยสมัครแล้ว') , new MessageTemplateActionBuilder('ยังไม่เคยสมัคร', 'ยังไม่เคยสมัคร') ]) );
        break;
    case 'เคยสมัครแล้ว':
        $MessageBuilder = new TextMessageBuilder('login flow') ;
        break;
    case 'ยังไม่เคยสมัคร':
        $MessageBuilder = new TextMessageBuilder('new member flow') ;
        break;
    default:
        $MessageBuilder = new TextMessageBuilder('อย่าตอบนอกคำตอบที่ให้ไว้ไอสัส') ;
	}

	$response = $bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
}