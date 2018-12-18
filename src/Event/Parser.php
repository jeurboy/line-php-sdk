<?php

namespace Jeurboy\LineSdk\Event;

use Jeurboy\LineSdk\Event\Message\EventMessageInterface;
use Jeurboy\LineSdk\Event\Message\Text as EventMessageText;

class Parser
{
    /** @var jsonInput Reply message from Line's API webhooks */
    protected $jsonInput;

    /**
     * Method to send Message to Line Notify
     *
     * <code>
     *
     * $accessToken = '========== Access token ==========';
     * $channelSecret = '========== Channel secret key ==========';
     *
     * $request = file_get_contents('php://input');   // Get request content
     *
     * $line_bot = Line::bot($accessToken, $channelSecret);
     * $line_text = Line::textMessage();
     *
     * $parser = Line::eventParser($request);
     * $events = $parser->parseEvents();
     *
     * foreach ($events as $event) {
     *     switch ($event->getType()) {
     *         case 'Text':
     *             $line_text->setMessage('Test reply : '.$event->getMessage());
     *             $response = $line_bot->send($event->getReplyToken(), $line_text);
     *
     *             break;
     *     }
     *
     *     if ($response !== true) {
     *         echo $line_bot->getErrorMessage()."\n";
     *     }
     * }
     * </code>
     *
     * Example Reply from Line's webhook
     *
     * Text type
     * {
     *     "events": [
     *         {
     *             "type": "message",
     *             "replyToken": "****************",
     *             "source": {
     *                 "userId": "****************",,
     *                 "type": "user"
     *             },
     *             "timestamp": 1545036285243,
     *             "message": {
     *                 "type": "text",
     *                 "id": "123456789",
     *                 "text": "OK"
     *             }
     *         }
     *     ],
     *     "destination": "****************",
     * }
     *
     * {
     *    "events": [
     *        {
     *            "type": "message",
     *            "replyToken": "****************",
     *            "source": {
     *                "userId": "****************",
     *                "type": "user"
     *            },
     *            "timestamp": 1545037270427,
     *            "message": {
     *                "type": "sticker",
     *                "id": "123456789",
     *                "stickerId": "52002757",
     *                "packageId": "11537"
     *            }
     *        }
     *    ],
     *    "destination": "****************"
     * }
     */
    /**
     * Initialize class
     *
     * @param string $jsonInput Json string which response from Line's webhook
     *
     */
    public function __construct(string $jsonInput) {
        $this->jsonInput = json_decode($jsonInput, true);
    }

    public function parseEvents() : array {
        $jsonInputArray = $this->jsonInput;

        if (count($jsonInputArray) <= 0) {
            return [];
        }

        $return = [];

        foreach ($jsonInputArray["events"] as $eventJsonArray) {
            if ( $eventJsonArray['type'] == 'message' ) {
                $return[] = $this->parseEventMessage($eventJsonArray);
            }
        }

        return $return;
    }

    protected function parseEventMessage(array $jsonArray) : EventMessageInterface {

        if ($jsonArray['message']['type'] == "text") {
            return new EventMessageText($jsonArray);
        }

        return new EventMessageText($jsonArray);
    }
}
