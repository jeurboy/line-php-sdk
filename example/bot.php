<?php
namespace Jeurboy\LineSdk;

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$accessToken = '========== Access token ==========';
$channelSecret = '========== Channel secret key ==========';

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

$line_bot = Line::bot($accessToken, $channelSecret);

$line_text = Line::textMessage();

$parser = Line::eventParser($request);
$events = $parser->parseEvents();

foreach ($events as $event) {
    switch ($event->getType()) {
        case 'Text':
            $line_text->setMessage('Test reply : '.$event->getMessage());
            $line_bot->send($event->getReplyToken(), $line_text);

            break;
    }
}

echo "OK";
