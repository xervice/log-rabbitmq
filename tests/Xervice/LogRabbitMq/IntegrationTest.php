<?php
namespace XerviceTest\LogRabbitMq;

use DataProvider\LogMessageDataProvider;
use Xervice\Core\Locator\Locator;
use Xervice\DataProvider\DataProviderFacade;
use Xervice\Logger\LoggerFacade;
use Xervice\RabbitMQ\RabbitMQFacade;

require_once __DIR__ . '/TestInjector/LoggerDependencyProvider.php';
require_once __DIR__ . '/TestInjector/RabbitMQDependencyProvider.php';

class IntegrationTest extends \Codeception\Test\Unit
{

    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;
    
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
        $this->getRabbitMqFacade()->runWorker();

        $response = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(
            'LogTitle',
            $response
        );
    }

    /**
     * @return \Xervice\Logger\LoggerFacade
     */
    private function getLoggerFacade(): LoggerFacade
    {
        return Locator::getInstance()->logger()->facade();
    }

    /**
     * @return \Xervice\DataProvider\DataProviderFacade
     */
    private function getDataProviderFacade(): DataProviderFacade
    {
        return Locator::getInstance()->dataProvider()->facade();
    }

    /**
     * @return \Xervice\RabbitMQ\RabbitMQFacade
     */
    private function getRabbitMqFacade(): RabbitMQFacade
    {
        return Locator::getInstance()->rabbitMQ()->facade();
    }
}