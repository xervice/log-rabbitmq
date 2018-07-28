<?php


namespace Xervice\LogRabbitMq\Business\Queue;


use DataProvider\LogMessageDataProvider;
use DataProvider\RabbitMqMessageCollectionDataProvider;
use PhpAmqpLib\Channel\AMQPChannel;
use Xervice\RabbitMQ\Worker\Listener\AbstractListener;

/**
 * @method \Xervice\LogRabbitMq\LogRabbitMqFactory getFactory()
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
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function getQueueName(): string
    {
        return $this->getFactory()->createLogQueue()->getName();
    }

}