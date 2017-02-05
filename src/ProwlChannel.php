<?php

namespace godforhire\ProwlNotifications;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;
use godforhire\ProwlNotifications\Exceptions\InvalidConfiguration;
use godforhire\ProwlNotifications\Exceptions\CouldNotSendNotification;

class ProwlChannel
{
	/**
	 * API Endpoinr
	 */
    const API_ENDPOINT = 'https://api.prowlapp.com/publicapi/add';

    /**
     * @var $client
     */
    protected $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \godforhire\ProwlNotifications\Exceptions\InvalidConfiguration
     * @throws \godforhire\ProwlNotifications\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
 	    if (!$token = config('services.prowl.token'))
        {
            throw InvalidConfiguration::configurationNotSet();
        }

        $message = $notification->toProwl($notifiable);
        $data = $message->toArray() + [
        	'apikey' => $token
        ];

        $response = $this->client->post(self::API_ENDPOINT, [
            'http_errors' => false,
            'form_params' => $data
        ]);

        if ($response->getStatusCode() !== 200)
        {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }
}