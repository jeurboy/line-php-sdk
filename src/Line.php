<?php

namespace Jeurboy\LineSdk;

class Line
{
    /**
     * Create notify Object
     *
     * @return Notify\Notify
     */
    public static function notify(string $token)
    {
        return new Notify\Notify($token);
    }

    /**
     * Create Text Message object
     *
     * @return Notify\Notify
     */
    public static function textMessage()
    {
        return new Message\Text();
    }
}
