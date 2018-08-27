<?php


namespace Xervice\LogRabbitMq\Business;


use DataProvider\RabbitMqExchangeDataProvider;
use DataProvider\RabbitMqQueueBindDataProvider;
use DataProvider\RabbitMqQueueDataProvider;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\LogRabbitMq\LogRabbitMqDependencyProvider;
use Xervice\RabbitMQ\Business\Model\Core\ExchangeProvider;
use Xervice\RabbitMQ\Business\RabbitMQFacade;

/**
 * @method \Xervice\LogRabbitMq\LogRabbitMqConfig getConfig()
 */
class LogRabbitMqBusinessFactory extends AbstractBusinessFactory
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
     * @return \Xervice\RabbitMQ\Business\RabbitMQFacade
     */
    public function getRabbitMqFacade(): RabbitMQFacade
    {
        return $this->getDependency(LogRabbitMqDependencyProvider::RABBITMQ_FACADE);
    }
}