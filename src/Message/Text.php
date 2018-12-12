<?php

namespace Jeurboy\LineSdk\Message;

class Text extends Message implements MessageInterface
{
    protected $textMessage = '';

    /**
     * Initialize class for create Text type message instance
     *
     * @param string $message
     */
    public function __construct(string $message = '')
    {
        if ($message != '') {
            $this->setText($message);
        }
    }

    /**
     * Method to setting text message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->textMessage = $message;
    }

    /**
     * Method to setting text message
     *
     * @return string method to retrive message
     */
    public function getMessage() : string
    {
        return $this->textMessage;
    }
}
