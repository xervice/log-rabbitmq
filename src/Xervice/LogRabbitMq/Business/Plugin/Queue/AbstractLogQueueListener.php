<?php


namespace Xervice\LogRabbitMq\Business\Plugin\Queue;


use DataProvider\LogMessageDataProvider;
use DataProvider\RabbitMqMessageCollectionDataProvider;
use PhpAmqpLib\Channel\AMQPChannel;
use Xervice\RabbitMQ\Business\Model\Worker\Listener\AbstractListener;

/**
 * @method \Xervice\LogRabbitMq\Business\LogRabbitMqBusinessFactory getFactory()
 */
abstract class AbstractLogQueueListener extends AbstractListener
{
    /**
     * @param \DataProvider\RabbitMqMessageCollectionDataProvider $collectionDataProvider
     * @param \PhpAmqpLib\Channel\AMQPChannel $channel
     */
    public function handleMessage(
        RabbitMqMessageCollectionDataProvider $collectionDataProvider,
        AMQPChannel $channel
    ): void {
        foreach ($collectionDataProvider->getMessages() as $message) {
            if ($message->getMessage() instanceof LogMessageDataProvider) {
                $this->handleLog($message->getMessage());
            }

            $this->sendAck($channel, $message);
        }
    }

    abstract public function handleLog(LogMessageDataProvider $dataProvider);

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->getFactory()->createLogQueue()->getName();
    }

}