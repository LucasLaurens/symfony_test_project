# __symfony_test_project__

## __Features__
- Service
- Event Subscriber
- Command
- MailInterface
- Entity | Repository | CRUD
- Messenger
- Feature Behat

<hr />

### __Messenger__
- Handler: Logic of the business (ex: MailNotificationHandler)

```php
namespace App\MessageHandler;

use App\Message\MyMessage;

class MyMessageHandler
{
    public function __invoke(MyMessage $message)
    {
        // Message processing...
    }
}
```

#### __To create a new message and handler pair__
```bash
symfony console make:message
```

### __To start all server and check the mails__
```bash
docker-compose up -d
symfony server:stop
symfony serve -d
symfony open:local:webmail
```

#### __To consume your messages in queues__
```bash
symfony console messenger:consume async -vv
```

### __Run the Behat test__
```bash
# with --init at the first time
./vendor/bin/behat
```

### __Run the php unit test__
```bash
php bin/phpunit
```

### __Run the Selenium server__
```bash
selenium-server -port 4444
```
