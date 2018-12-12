<?php

namespace Jeurboy\LineSdk;

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$receipientToken = '========== Notify token ==========';

$line_noti = Line::notify($receipientToken);

$line_text = Line::textMessage();
$line_text->setMessage('Test');

if ($line_noti->send($line_text) !== true) {
    echo $line_noti->getErrorMessage()."\n";
} else {
    echo "Success\n";
}
