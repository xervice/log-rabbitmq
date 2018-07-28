<?php


namespace Xervice\LogRabbitMq;


use DataProvider\RabbitMqExchangeDataProvider;
use DataProvider\RabbitMqQueueBindDataProvider;
use DataProvider\RabbitMqQueueDataProvider;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\RabbitMQ\Core\ExchangeProvider;
use Xervice\RabbitMQ\RabbitMQClient;

/**
 * @method \Xervice\LogRabbitMq\LogRabbitMqConfig getConfig()
 */
class LogRabbitMqFactory extends AbstractFactory
{

    /**
     * @return \DataProvider\RabbitMqQueueBindDataProvider
     */
    public function createLogQueueBind(): RabbitMqQueueBindDataProvider
    {
        return (new RabbitMqQueueBindDataProvider())
            ->setExchange(
                $this->createLogExchange()
            )
            ->setQueue(
                $this->createLogQueue()
            );
    }

    /**
     * @return \DataProvider\RabbitMqQueueDataProvider
     */
    public function createLogQueue(): RabbitMqQueueDataProvider
    {
        return (new RabbitMqQueueDataProvider())
            ->setName(
                $this->getConfig()->getQueueName()
            )
            ->setAutoDelete(false);
    }

    /**
     * @return \DataProvider\RabbitMqExchangeDataProvider
     */
    public function createLogExchange(): RabbitMqExchangeDataProvider
    {
        return (new RabbitMqExchangeDataProvider())
            ->setName(
                $this->getConfig()->getExchangeName()
            )
            ->setType(ExchangeProvider::TYPE_FANOUT)
            ->setAutoDelete(false);
    }

    /**
     * @return \Xervice\RabbitMQ\RabbitMQClient
     */
    public function getRabbitMqClient(): RabbitMQClient
    {
        return $this->getDependency(LogRabbitMqDependencyProvider::RABBITMQ_CLIENT);
    }
}