# __symfony_test_project__

## __Features__
- Service
- Event Subscriber
- Command
- MailInterface
- Entity | Repository | CRUD
- Messenger

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

#### __To consume your messages in queues__
```bash
symfony console messenger:consume async -vv
```
