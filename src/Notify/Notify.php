<?php

namespace Jeurboy\LineSdk\Notify;

use GuzzleHttp\Client;
use \Jeurboy\LineSdk\Message\MessageInterface as MessageInterface;
use \Jeurboy\LineSdk\Message\Text as TextMessage;

class Notify
{
    const API_URL = 'https://notify-api.line.me/api/notify';

    /** @var accessToken Notify access token to access Line's notify api*/
    protected $accessToken;

    /** @var errorMessage */
    protected $errorMessage = "";

    /**
     * Initialize class with Line notify token string
     *
     * @param string $accessToken the token of Line notify API
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->httpClient = new Client();
    }

    /**
     * Method to get error message after send method was execute
     *
     * @return string error message
     */
    public function getErrorMessage() : string
    {
        return $this->errorMessage;
    }

    /**
     * Method to send Message to Line Notify
     *
     * <code>
     * $line_noti = Line::notify('ACCESS_TOKEN');
     *
     * $line_text = Line::textMessage(); // Init text message object
     * $line_text->setMessage('Test');
     *
     * if ($line_noti->send( $line_text ) !== true) {
     *     echo $line_noti->getErrorMessage()."\n";
     * } else {
     *     echo "Success\n";
     * }
     * </code>
     *
     * @param MessageInterface $message an object for message which will be sent to user which can be foillowing type
     *                                  - TextMessage, etc
     *
     * @return bool status of sending to notify API
     */

    public function send(MessageInterface $message) : bool
    {
        if ($message instanceof TextMessage) {
            $response = $this->sendTextMessage($message);
        }

        if ($response === true) {
            return true;
        }

        return false;
    }

    /**
     * Method to handle text type message
     *
     * @param TextMessage $message an object of TextMessage
     *
     * @return bool status of sending to notify API
     */
    protected function sendTextMessage(TextMessage $message) : bool
    {
        $requestParams = $this->getRequestParam();

        $requestParams['multipart'] = [
            [
                'name' => 'message',
                'contents' => $message->getMessage()
            ]
        ];

        try {
            $response = $this->httpClient->request('POST', Notify::API_URL, $requestParams);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $this->errorMessage = $e->getResponse()->getReasonPhrase();

            return false;
        }

        if ($response->getStatusCode() != 200) {
            return false;
        }

        $body = (string) $response->getBody();
        $json = json_decode($body, true);

        if (empty($json['status']) || empty($json['message'])) {
            return false;
        }

        return true;
    }

    private function getRequestParam()
    {
        return [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
            ],
        ];
    }
}
