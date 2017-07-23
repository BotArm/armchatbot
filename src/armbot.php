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
        $bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
        break;

    case 'เคยสมัครแล้ว':

        $MessageBuilder = new TextMessageBuilder('login flow') ;
        $bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
        break;

    case 'ยังไม่เคยสมัคร':

    	$MessageBuilder = new TemplateMessageBuilder('ทดสอบ', new ConfirmTemplateBuilder('กรุณาระบุว่าเป็นอาจารย์ / นิสิต ', 
		[ new MessageTemplateActionBuilder('อาจารย์', 'อาจารย์') , new MessageTemplateActionBuilder('นิสิต', 'นิสิต') ]) );
		$bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
        break;

    case 'อาจารย์':
    	$session = 'regis' ;
    	$lastMsg = 'กรุณาระบุรหัสอาจารย์' ;
    	$MessageBuilder = new TextMessageBuilder('กรุณาระบุรหัสอาจารย์') ;
    	$bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
        break;

    case 'นิสิต':
    	$session = "regis" ;
    	$lastMsg = 'กรุณาระบุรหัสนิสิต' ;
    	$MessageBuilder = new TextMessageBuilder('กรุณาระบุรหัสนิสิต') ;
    	$bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
        break;

    default:
        $MessageBuilder = new TextMessageBuilder('อย่าพิมอย่างอื่นไอหน่อม') ;
        $bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
	}

	if($session == 'regis'){
		switch ($lastMsg) {
		case 'กรุณาระบุรหัสอาจารย์' || 'กรุณาระบุรหัสนิสิต' :
			$MessageBuilder = new TemplateMessageBuilder('ทดสอบ', new ConfirmTemplateBuilder('ยืนยันรหัส'.$msg, 
			[ new MessageTemplateActionBuilder('ใช่', 'ใช่') , new MessageTemplateActionBuilder('ไม่ใช่', 'ไม่ใช่') ]) );
			$response = $bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
			break;

		default:
        	$MessageBuilder = new TextMessageBuilder('อย่าพิมอย่างอื่นไอหน่อม') ;
        	$bot->replyMessage( $event['replyToken'] , $MessageBuilder);  
		}
	} else {
		
	}

	
}