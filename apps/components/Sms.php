<?php

namespace components;

use AfricasTalking\SDK\AfricasTalking;
class Sms
{
    const apiKey   = '39d6ee3bed35128162d45e5b0e68275116de838ee0d657546de71758a82a2c01';
    const username = 'cicsystems';
    const sender   = '';

    public static function sendOtp($data)
    {
        return self::gateway($data['to'], $data['msg']);
    }    
    protected static function gateway($receiver = [], $message = '')
    {
        $gateway  = new AfricasTalking(self::username, self::apiKey);
        return $gateway->sms()->send([
            'to'      => $receiver,
            'message' => $message,
            'from'    => self::sender,
            'enqueue' => true
        ]);
    }
}

