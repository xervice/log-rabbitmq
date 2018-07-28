LogRabbitMq
=====================

[![Build Status](https://travis-ci.org/xervice/lograbbitmq).svg?branch=master)](https://travis-ci.org/xervice/lograbbitmq)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/log-rabbitmq/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/log-rabbitmq/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/log-rabbitmq/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/log-rabbitmq/?branch=master)

Installation
-----------------
```
composer require xervice/log-rabbitmq
```

Configuration
-----------------

To use rabbitmq as log provider, you have to define it in the LoggerDependencyProvider and RabbitMQDepoendencyProvider.

```php
<?php

namespace App\Logger;

use Xervice\Logger\LoggerDependencyProvider as XerviceLoggerDependencyProvider;
use Xervice\LogRabbitMq\Business\Log\QueueLogHandler;

class LoggerDependencyProvider extends XerviceLoggerDependencyProvider
{
    /**
     * @return array
     */
    protected function getLogHandler(): array
    {
        return [
            new QueueLogHandler()
        ];
    }

}
```

```php
<?php

namespace App\RabbitMQ;

use Xervice\LogRabbitMq\Business\Queue\LogExchange;
use Xervice\LogRabbitMq\Business\Queue\LogQueue;
use Xervice\RabbitMQ\RabbitMQDependencyProvider as XerviceRabbitMQDependencyProvider;
use XerviceTest\LogRabbitMq\Listener\LogListener;

class RabbitMQDependencyProvider extends XerviceRabbitMQDependencyProvider
{
    /**
     * @return array
     */
    protected function getQueues(): array
    {
        return [
            new LogQueue()
        ];
    }

    /**
     * @return array
     */
    protected function getExchanges(): array
    {
        return [
            new LogExchange()
        ];
    }

}
```

To add LogHandler as Worker you can extend from \Xervice\LogRabbitMq\Business\Queue\AbstractLogQueueListener.

***Example***
```php
<?php


namespace XerviceTest\LogRabbitMq\Listener;


use DataProvider\LogMessageDataProvider;
use Xervice\LogRabbitMq\Business\Queue\AbstractLogQueueListener;

class LogListener extends AbstractLogQueueListener
{
    /**
     * @param \DataProvider\LogMessageDataProvider $dataProvider
     */
    public function handleLog(LogMessageDataProvider $dataProvider)
    {
        echo $dataProvider->getTitle();
    }
}
```

***Adding to RabbitMQDependencyProvider***
```php
<?php

namespace App\RabbitMQ;

use Xervice\RabbitMQ\RabbitMQDependencyProvider as XerviceRabbitMQDependencyProvider;
use XerviceTest\LogRabbitMq\Listener\LogListener;

class RabbitMQDependencyProvider extends XerviceRabbitMQDependencyProvider
{
    /**
     * @return array
     */
    protected function getListener(): array
    {
        return [
            new LogListener()
        ];
    }
}
```