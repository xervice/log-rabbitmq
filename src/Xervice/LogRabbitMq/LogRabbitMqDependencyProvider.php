<?php


namespace Xervice\LogRabbitMq;


use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Dependency\Provider\AbstractDependencyProvider;

class LogRabbitMqDependencyProvider extends AbstractDependencyProvider
{
    public const RABBITMQ_FACADE = 'rabbitmq.facade';

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function handleDependencies(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container[self::RABBITMQ_FACADE] = function (DependencyContainerInterface $container) {
            return $container->getLocator()->rabbitMQ()->facade();
        };

        return $container;
    }
}