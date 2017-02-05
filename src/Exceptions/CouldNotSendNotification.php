<?php

namespace godforhire\ProwlNotifications\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static("Prowl responded with an error: {$response->getStatusCode()} {$response->getReasonPhrase()} - {$response->getBody()}");
    }
}