<?php


namespace Xervice\LogRabbitMq\Business\Queue;


use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\RabbitMQ\Core\ExchangeProviderInterface;
use Xervice\RabbitMQ\Exchange\ExchangeInterface;

/**
 * @method \Xervice\LogRabbitMq\LogRabbitMqFactory getFactory()
 */
class LogExchange extends AbstractWithLocator implements ExchangeInterface
{
    /**
     * @param \Xervice\RabbitMQ\Core\ExchangeProviderInterface $exchangeProvider
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function declareExchange(ExchangeProviderInterface $exchangeProvider)
    {
        $exchangeProvider->declare(
            $this->getFactory()->createLogExchange()
        );
    }
}