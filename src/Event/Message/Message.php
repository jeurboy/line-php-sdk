<?php

namespace Jeurboy\LineSdk\Event\Message;

abstract class Message implements EventMessageInterface
{
    /** @var messages Reply message from Line's API webhooks */
    protected $messages;

   /**
     * Method to send Message to Line Notify
     *
     * <code>
     *
     * $events = $parser->parseEvents();
     *
     * foreach ($events as $event) {
     *     switch ($event->getType()) {
     *          case 'Text':
     *              $line_text->setMessage('Test reply : '.$event->getMessage());
     *              $line_bot->send($event->getReplyToken(), $line_text);
     *          break;
     *
     *      }
     * }
     *
     * </code>
     *
     */
    /**
     * Reply from Line's webhook
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
     */
    public function __construct(array $messages)
    {
        $this->messages =  $messages;
    }

    public function getReplyToken() : string
    {
        return $this->messages['replyToken'];
    }
}
