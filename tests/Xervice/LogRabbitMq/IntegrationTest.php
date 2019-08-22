<?php
namespace XerviceTest\LogRabbitMq;

use DataProvider\LogMessageDataProvider;
use DataProvider\RabbitMqWorkerConfigDataProvider;
use Xervice\Core\Business\Model\Locator\Locator;
use Xervice\DataProvider\Business\DataProviderFacade;
use Xervice\Logger\Business\LoggerFacade;
use Xervice\RabbitMQ\Business\RabbitMQFacade;

require_once __DIR__ . '/TestInjector/LoggerDependencyProvider.php';
require_once __DIR__ . '/TestInjector/RabbitMQDependencyProvider.php';

class IntegrationTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        $this->getDataProviderFacade()->generateDataProvider();
    }

    /**
     * @group Xervice
     * @group LogRabbitMq
     * @group Integration
     */
    public function testLogRabbitMq()
    {
        $log = new LogMessageDataProvider();
        $log
            ->setTitle('LogTitle');

        ob_start();
        $this->getRabbitMqFacade()->init();
        $this->getLoggerFacade()->log($log);

        $config = new RabbitMqWorkerConfigDataProvider();

        $this->getRabbitMqFacade()->runWorker($config);

        $response = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(
            'LogTitle',
            $response
        );
    }

    /**
     * @return \Xervice\Logger\Business\LoggerFacade
     */
    private function getLoggerFacade(): LoggerFacade
    {
        return Locator::getInstance()->logger()->facade();
    }

    /**
     * @return \Xervice\DataProvider\Business\DataProviderFacade
     */
    private function getDataProviderFacade(): DataProviderFacade
    {
        return Locator::getInstance()->dataProvider()->facade();
    }

    /**
     * @return \Xervice\RabbitMQ\Business\RabbitMQFacade
     */
    private function getRabbitMqFacade(): RabbitMQFacade
    {
        return Locator::getInstance()->rabbitMQ()->facade();
    }
}
