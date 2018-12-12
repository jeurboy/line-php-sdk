line-php-sdk
========

PHP Line SDK Class

[Line Notify Document](https://notify-bot.line.me/doc/en/)


## Requirement
* PHP 7+
* [guzzlehttp](https://github.com/guzzle/guzzle)

## Composer

Install the latest version with composer

```
composer require jeurboy/line-php-sdk
```

## Generate Line Notify Token

[https://notify-bot.line.me/my/](https://notify-bot.line.me/my/)

## Notify Usage
*Example : Simple notify with text message*
```php
namespace Jeurboy\LineSdk;

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$receipientToken = '========== Notify token ==========';

$line_noti = Line::notify($receipientToken);

$line_text = Line::textMessage();
$line_text->setMessage('Test');

if ($line_noti->send( $line_text ) !== true) {
    echo $line_noti->getErrorMessage()."\n";
} else {
    echo "Success\n";
}
```

License
=======
Jeurboy License
