<?php


namespace App\Logger;


use Xervice\Logger\LoggerDependencyProvider as XerviceLoggerDependencyProvider;
use Xervice\LogRabbitMq\Business\Log\QueueLogHandler;

class LoggerDependencyProvider extends XerviceLoggerDependencyProvider
{
    /**
     * @return array
     */
    protected function getLogHandler(): array
    {
        return [
            new QueueLogHandler()
        ];
    }

}