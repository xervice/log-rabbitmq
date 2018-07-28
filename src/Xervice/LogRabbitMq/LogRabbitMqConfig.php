<?php


namespace Xervice\LogRabbitMq;


use Xervice\Core\Config\AbstractConfig;

class LogRabbitMqConfig extends AbstractConfig
{
    public const QUEUE_NAME = 'queue.name';

    public const EXCHANGE_NAME = 'exchange.name';

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->get(self::QUEUE_NAME, 'log');
    }

    /**
     * @return string
     */
    public function getExchangeName(): string
    {
        return $this->get(
            self::EXCHANGE_NAME,
            $this->getQueueName()
        );
    }
}