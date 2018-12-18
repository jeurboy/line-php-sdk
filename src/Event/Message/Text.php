<?php

namespace Jeurboy\LineSdk\Event\Message;

class Text extends Message implements EventMessageInterface
{
    public function getType() : string
    {
        return "Text";
    }

    public function getMessage() : string
    {
        return (!empty($this->messages['message']['text'])) ? $this->messages['message']['text']: "";
    }
}

// Next step Handle user follow action
//
// {
//     "events": [
//         {
//             "type": "follow",
//             "replyToken": "****************",
//             "source": {
//                 "userId": "****************",
//                 "type": "user"
//             },
//             "timestamp": 1545041643191
//         }
//     ],
//     "destination": "****************",
// }