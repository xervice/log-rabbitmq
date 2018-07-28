<?php


namespace Xervice\LogRabbitMq;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class LogRabbitMqDependencyProvider extends AbstractProvider
{
    public const RABBITMQ_CLIENT = 'rabbitmq.facade';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::RABBITMQ_CLIENT] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->rabbitMQ()->client();
        };
    }
}