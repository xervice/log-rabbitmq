<?php


namespace XerviceTest\LogRabbitMq\Listener;


use DataProvider\LogMessageDataProvider;
use Xervice\LogRabbitMq\Business\Plugin\Queue\AbstractLogQueueListener;

class LogListener extends AbstractLogQueueListener
{
    /**
     * @param \DataProvider\LogMessageDataProvider $dataProvider
     */
    public function handleLog(LogMessageDataProvider $dataProvider)
    {
        echo $dataProvider->getTitle();
    }
}