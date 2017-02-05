<?php

namespace godforhire\ProwlNotifications\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function configurationNotSet()
    {
        return new static('In order to send Prowl notifications you need to add your API Token to the `prowl` key of `config.services`.');
    }
}