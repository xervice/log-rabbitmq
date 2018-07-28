<?php


namespace Xervice\LogRabbitMq\Business\Log;


use DataProvider\LogMessageDataProvider;
use DataProvider\RabbitMqMessageDataProvider;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\Logger\Business\Handler\LogHandlerInterface;

/**
 * @method \Xervice\LogRabbitMq\LogRabbitMqFactory getFactory()
 */
class QueueLogHandler extends AbstractWithLocator implements LogHandlerInterface
{
    /**
     * @param \DataProvider\LogMessageDataProvider $messageDataProvider
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function handleLog(LogMessageDataProvider $messageDataProvider): void
    {
        $message = new RabbitMqMessageDataProvider();
        $message
            ->setExchange(
                $this->getFactory()->createLogExchange()
            )
            ->setMessage($messageDataProvider);

        $this->getFactory()->getRabbitMqClient()->sendMessage($message);
    }
}