<?php


namespace Xervice\LogRabbitMq\Business\Plugin\Log;


use DataProvider\LogMessageDataProvider;
use DataProvider\RabbitMqMessageDataProvider;
use Xervice\Core\Plugin\AbstractBusinessPlugin;
use Xervice\Logger\Business\Dependency\Handler\LogHandlerInterface;

/**
 * @method \Xervice\LogRabbitMq\Business\LogRabbitMqBusinessFactory getFactory()
 */
class QueueLogHandler extends AbstractBusinessPlugin implements LogHandlerInterface
{
    /**
     * @param \DataProvider\LogMessageDataProvider $messageDataProvider
     */
    public function handleLog(LogMessageDataProvider $messageDataProvider): void
    {
        $message = new RabbitMqMessageDataProvider();
        $message
            ->setExchange(
                $this->getFactory()->createLogExchange()
            )
            ->setMessage($messageDataProvider);

        $this->getFactory()->getRabbitMqFacade()->sendMessage($message);
    }
}