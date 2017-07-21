<?php

require_once('./LINEBot.php');

$channelAccessToken = 'QFW5zx4qTkWfWsQKNlaOf5lDCgFTNt+wKV8rw5P/8UlQxbOqNarlInIwuoEcNqgwiJhZTHen75QixKLah1ttM+Ms6snrxNSPcYV+284HLUEEbflnJuN5xHBCsvsOjaqXyoCW3lHu8uWgMwzL5pgPjAdB04t89/1O/w1cDnyilFU=';
$channelSecret = '255befc1f82d6539c481e5f593e92517';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($channelAccessToken);
$client = new LINEBot($httpClient, ['channelSecret' => $channelSecret]);
