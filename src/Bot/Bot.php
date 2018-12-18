<?php

namespace Jeurboy\LineSdk\Bot;

use GuzzleHttp\Client;
use \Jeurboy\LineSdk\Message\MessageInterface as MessageInterface;
use \Jeurboy\LineSdk\Message\Text as TextMessage;

class Bot
{
    /** @var accessToken Notify access token to access Line's messaging api*/
    protected $accessToken;

    /** @var channelSecret channelSecret to access Line's messaging api*/
    protected $channelSecret;

    /** @var bot Line's bot api */
    /** @type \LINE\LINEBot */
    protected $bot;

    /**
     * Initialize class with Line bot token string
     *
     * @param string $accessToken the token of Line notify API
     * @param string $channelSecret the channelSecret of Line notify API
     */
    public function __construct(string $accessToken, string $channelSecret)
    {
        $this->accessToken = $accessToken;
        $this->channelSecret = $channelSecret;
        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($accessToken);

        $this->bot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $channelSecret]);
    }

    public function send(string $replyToken, MessageInterface $message) : bool
    {
        if ($message instanceof TextMessage) {
            $response = $this->sendMessage($replyToken, $message->getMessage());
        }

        if ($response === true) {
            return true;
        }

        return false;
    }

    /**
     * Method to handle text type message
     *
     * @param string $message
     *
     * @return bool status of sending to notify API
     */
    protected function sendMessage(string $replyToken, string $message) : bool
    {
        $response = $this->bot->replyText($replyToken, $message);

        if ($response->isSucceeded()) {
            return true;
        }

        return false;
    }
}
