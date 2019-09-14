# Prowl Push Notifications Channel for Laravel 6

[![Latest Version on Packagist](https://img.shields.io/packagist/v/godforhire/prowlnotifications.svg?style=flat-square)](https://packagist.org/packages/godforhire/prowlnotifications)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/godforhire/prowlnotifications.svg?style=flat-square)](https://packagist.org/packages/godforhire/prowlnotifications)

This package makes it easy to send notifications using [Prowl](https://prowlapp.com) with Laravel 6.

## Contents

* [Installation](#installation)
	* [Setting up the Prowl service](#setting-up-the-prowl-service)
* [Usage](#usage)
	* [Available Message methods](#available-message-methods)
* [Changelog](#changelog)
* [License](#license)

## Installation
You can install the package via composer:

```bash
composer require godforhire/prowlnotifications
```

### Setting up the Prowl service
Add your Prowl API Token to your `config/services.php`:

```php
// config/services.php
'prowl' => [
    'token' => env('PROWL_API_KEY'),
]
```

## Usage
Now you can use the channel in your `via()` method inside the notification:

```php
use godforhire\ProwlNotifications\ProwlChannel;
use godforhire\ProwlNotifications\ProwlMessage;
use Illuminate\Notifications\Notification;

class BackupHasFailed extends Notification
{
    public function via($notifiable)
    {
        return [ProwlChannel::class];
    }

    public function toProwl($notifiable)
    {
        return ProwlMessage::create()
                    ->priority(2)
                    ->url('http://your.app');
                    ->application("Your App")
                    ->event("Backup failed")
                    ->description("Daily backup of Your App has failed: reason, disk S3 is unreachable.")
    }
}
```

### Available Message methods

* `priority` Optional. Default value of 0 if not provided. An integer value ranging [-2, 2] representing: -2 Very Low, -1 Moderate, 0 Normal, 1 High, 2 Emergency. Emergency priority messages may bypass quiet hours according to the user's settings.
* `url` [512] Optional. The URL which should be attached to the notification. This will trigger a redirect when launched, and is viewable in the notification list.
* `application` [256] The name of your application or the application generating the event.
* `event` [1024] The name of the event or subject of the notification.
* `description` [10000] A description of the event, generally terse.

For more information [see Prowl website](https://www.prowlapp.com/api.php).

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
