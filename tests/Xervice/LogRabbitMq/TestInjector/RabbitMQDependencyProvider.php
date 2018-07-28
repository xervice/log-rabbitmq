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
    protected function getListener(): array
    {
        return [
            new LogListener()
        ];
    }

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