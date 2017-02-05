<?php

namespace godforhire\ProwlNotifications;

class ProwlMessage
{
    /**
     * Optional. Default value of 0 if not provided. An integer value ranging [-2, 2] very low to emergency
     *
     * @var string
     */
    protected $priority = 0;

    /**
     * Optional. The URL which should be attached to the notification.
     *
     * @var string
     */
    protected $url;

	/**
	 * The name of your application or the application generating the event.
	 *
	 * @var string
	 */
    protected $application;

	/**
	 * The name of the event or subject of the notification.
	 *
	 * @var string
	 */
    protected $event;

	/**
	 * A description of the event, generally terse.
	 *
	 * @var string
	 */
    protected $description;

    /**
     * Construct
     * @param string $description
     */
    public function __construct($description = '')
    {
        $this->description = $description;
    }

    /**
     * Create a message.
     *
     * @param string $description
     * @return static
     */
    public static function create($description = '')
    {
        return new static($description);
    }

    /**
     * Set the message description.
     *
     * @param string $value
     * @return $this
     */
    public function description($value)
    {
        $this->description = $value;
        return $this;
    }

    /**
     * Set the message priority.
     *
     * @param string $value
     * @return $this
     */
    public function priority($value)
    {
        $this->priority = $value;
        return $this;
    }

    /**
     * Set the message url.
     *
     * @param string $value
     * @return $this
     */
    public function url($value)
    {
        $this->url = $value;
        return $this;
    }

    /**
     * Set the application name.
     *
     * @param string $value
     * @return $this
     */
    public function application($value)
    {
        $this->application = $value;
        return $this;
    }

    /**
     * Set the event name.
     *
     * @param string $value
     * @return $this
     */
    public function event($value)
    {
        $this->event = $value;
        return $this;
    }

    /**
     * Get message as array.
     *
     * @return array
     */
    public function toArray()
    {
        $message = [
            'priority' => $this->priority,
            'url' => $this->url,
            'application' => $this->application,
            'event' => $this->event,
            'description' => $this->description,
        ];
        return $message;
    }
}