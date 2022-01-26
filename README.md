# symfony_test_project

## Features
- Service
- Event Subscriber
- Command
- MailInterface
- Entity | Repository | CRUD
- Messenger

<hr />

### Messenger
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

To consume your messages in queues
```bash
symfony console messenger:consume async -vv
```
