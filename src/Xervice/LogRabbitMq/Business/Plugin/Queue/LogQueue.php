<?php


namespace Xervice\LogRabbitMq\Business\Plugin\Queue;
use Xervice\Core\Plugin\AbstractBusinessPlugin;
use Xervice\RabbitMQ\Business\Dependency\Queue\QueueInterface;
use Xervice\RabbitMQ\Business\Model\Core\QueueProviderInterface;


/**
 * @method \Xervice\LogRabbitMq\Business\LogRabbitMqBusinessFactory getFactory()
 */
class LogQueue extends AbstractBusinessPlugin implements QueueInterface
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