<?php


namespace Xervice\LogRabbitMq\Business\Plugin\Queue;


use Xervice\Core\Plugin\AbstractBusinessPlugin;
use Xervice\RabbitMQ\Business\Dependency\Exchange\ExchangeInterface;
use Xervice\RabbitMQ\Business\Model\Core\ExchangeProviderInterface;

/**
 * @method \Xervice\LogRabbitMq\Business\LogRabbitMqBusinessFactory getFactory()
 */
class LogExchange extends AbstractBusinessPlugin implements ExchangeInterface
{
    /**
     * @param \Xervice\RabbitMQ\Business\Model\Core\ExchangeProviderInterface $exchangeProvider
     */
    public function declareExchange(ExchangeProviderInterface $exchangeProvider)
    {
        $exchangeProvider->declare(
            $this->getFactory()->createLogExchange()
        );
    }
}