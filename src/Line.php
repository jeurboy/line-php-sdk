<?php

namespace Jeurboy\LineSdk;

class Line
{
    /**
     * Create notify Object
     *
     * @return Notify\Notify
     */
    public static function notify(string $token) : Notify\Notify
    {
        return new Notify\Notify($token);
    }

    /**
     * Create bot Object
     *
     * @return Bot\Bot
     */
    public static function bot(string $token, string $channelSecret) : Bot\Bot
    {
        return new Bot\Bot($token, $channelSecret);
    }

    /**
     * Create Text Message object
     *
     * @return Message\Text
     */
    public static function textMessage() : Message\Text
    {
        return new Message\Text();
    }

    /**
     * Create Parser object
     *
     * @return Event\Parser
     */
    public static function eventParser(string $lineCallbackJson) : Event\Parser
    {
        return new Event\Parser($lineCallbackJson);
    }
}
