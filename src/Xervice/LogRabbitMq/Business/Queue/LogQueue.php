<?php


namespace Xervice\LogRabbitMq\Business\Queue;


use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\RabbitMQ\Core\ExchangeProviderInterface;
use Xervice\RabbitMQ\Core\QueueProviderInterface;
use Xervice\RabbitMQ\Exchange\ExchangeInterface;
use Xervice\RabbitMQ\Queue\QueueInterface;

/**
 * @method \Xervice\LogRabbitMq\LogRabbitMqFactory getFactory()
 */
class LogQueue extends AbstractWithLocator implements QueueInterface
{
    public function declareQueue(QueueProviderInterface $queueProvider)
    {
        $queueProvider->declare(
            $this->getFactory()->createLogQueue()
        );

        $queueProvider->bind(
            $this->getFactory()->createLogQueueBind()
        );
    }
}