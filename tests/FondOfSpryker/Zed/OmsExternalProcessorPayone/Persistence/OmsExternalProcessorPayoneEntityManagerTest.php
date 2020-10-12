<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence;


use Codeception\Test\Unit;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use Propel\Runtime\Collection\ObjectCollection;


/**
 * Auto-generated group annotations
 * @group FondOfSpryker
 * @group Zed
 * @group OmsExternalProcessorPayone
 * @group Persistence
 * @group OmsExternalProcessorPayoneEntityManagerTest
 * Add your own group annotations below this line
 */
class OmsExternalProcessorPayoneEntityManagerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayonePersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderQueryMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderMock;

    /**
     * @var \Propel\Runtime\Collection\ObjectCollection|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $objectCollection;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface
     */
    protected $entityManager;

    public function _before()
    {
        parent::_before();

        $this->objectCollection = $this->getMockBuilder(ObjectCollection::class)->disableOriginalConstructor()->getMock();
        $this->salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)->disableOriginalConstructor()->getMock();
        $this->salesOrderQueryMock = $this->getMockBuilder(SpySalesOrderQuery::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(OmsExternalProcessorPayonePersistenceFactory::class)->disableOriginalConstructor()->getMock();
        $this->entityManager = new OmsExternalProcessorPayoneEntityManager();
        $this->entityManager->setFactory($this->factoryMock);
    }

    public function testGetOrdersByStateAndAge()
    {
        $this->factoryMock->expects($this->once())->method('getSpySalesOrderQuery')->willReturn($this->salesOrderQueryMock);
        $this->salesOrderQueryMock->expects($this->once())->method('filterByIdItemState')->willReturn($this->salesOrderQueryMock);
        $this->salesOrderQueryMock->expects($this->once())->method('find')->willReturn($this->objectCollection);
        $this->salesOrderQueryMock->expects($this->never())->method('filterByCreatedAt_Between');
        $this->objectCollection->expects($this->once())->method('getData')->willReturn([]);

        $this->entityManager->getOrdersByStateAndAge(1);
    }

    public function testGetOrdersByStateAndAgeWithAgeProvided()
    {
        $self = $this;
        $this->factoryMock->expects($this->once())->method('getSpySalesOrderQuery')->willReturn($this->salesOrderQueryMock);
        $this->salesOrderQueryMock->expects($this->once())->method('filterByIdItemState')->willReturn($this->salesOrderQueryMock);
        $this->salesOrderQueryMock->expects($this->once())->method('find')->willReturn($this->objectCollection);
        $this->salesOrderQueryMock->expects($this->once())->method('filterByCreatedAt_Between')->will($this->returnCallback(static function($args)use($self){
            $self->assertArrayHasKey('min', $args);
            $self->assertArrayHasKey('max', $args);

            $min = new \DateTime($args['min']);
            $max = new \DateTime($args['max']);
            $diff = $max->diff($min);
            $self->assertSame(10, $diff->days);
        }));
        $this->objectCollection->expects($this->once())->method('getData')->willReturn([]);

        $this->entityManager->getOrdersByStateAndAge(1, 10);
    }
}
