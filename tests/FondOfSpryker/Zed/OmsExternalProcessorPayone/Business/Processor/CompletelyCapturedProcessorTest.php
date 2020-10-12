<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Business\Processor;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsInterface;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface;
use Generated\Shared\Transfer\ExternalProcessingResponseTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\Collection\ObjectCollection;

/**
 * Auto-generated group annotations
 *
 * @group FondOfSpryker
 * @group Zed
 * @group OmsExternalProcessorPayone
 * @group Business
 * @group Processor
 * @group CompletelyCapturedProcessorTest
 * Add your own group annotations below this line
 */
class CompletelyCapturedProcessorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $omsFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Business\Processor\CompletelyCapturedProcessorInterface
     */
    protected $processor;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(OmsExternalProcessorPayoneRepositoryInterface::class)->disableOriginalConstructor()->getMock();
        $this->entityManagerMock = $this->getMockBuilder(OmsExternalProcessorPayoneEntityManagerInterface::class)->disableOriginalConstructor()->getMock();
        $this->omsFacadeMock = $this->getMockBuilder(OmsExternalProcessorPayoneToOmsInterface::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(OmsExternalProcessorPayoneConfig::class)->getMock();

        $this->processor = new CompletelyCapturedProcessor(
            $this->repositoryMock,
            $this->entityManagerMock,
            $this->omsFacadeMock,
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testProcessCapturedOrdersNoOrdersFound()
    {
        $this->configMock->expects($this->once())->method('getCapturedStateName')->willReturn('captured');
        $this->repositoryMock->expects($this->once())->method('getStateIdByName')->willReturn(11);
        $this->entityManagerMock->expects($this->once())->method('getOrdersByStateAndAge')->willReturn([]);

        $responseTransferMock = $this->getMockBuilder(ExternalProcessingResponseTransfer::class)->getMock();
        $responseTransferMock->expects($this->never())->method('addProcessedOrder');
        $responseTransferMock->expects($this->never())->method('addFailedOrder');
        $this->processor->processCapturedOrders($responseTransferMock);
    }

    /**
     * @return void
     */
    public function testProcessCapturedOrdersItemsInWrongState()
    {
        $itemMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();
        $itemMock->method('getFkOmsOrderItemState')->willReturn(10);
        $salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)->disableOriginalConstructor()->getMock();
        $salesOrderMock->method('getItems')->willReturn([$itemMock]);

        $this->configMock->expects($this->once())->method('getCapturedStateName')->willReturn('captured');
        $this->repositoryMock->expects($this->once())->method('getStateIdByName')->willReturn(11);
        $this->entityManagerMock->expects($this->once())->method('getOrdersByStateAndAge')->willReturn([$salesOrderMock]);

        $responseTransferMock = $this->getMockBuilder(ExternalProcessingResponseTransfer::class)->getMock();
        $responseTransferMock->expects($this->never())->method('addProcessedOrder');
        $responseTransferMock->expects($this->never())->method('addFailedOrder');
        $this->processor->processCapturedOrders($responseTransferMock);
    }

    /**
     * @return void
     */
    public function testProcessCapturedOrders()
    {
        $itemMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();
        $itemMock->expects($this->once())->method('getFkOmsOrderItemState')->willReturn(11);
        $objectCollection = new ObjectCollection([$itemMock]);
        $salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)->disableOriginalConstructor()->getMock();
        $salesOrderMock->method('getItems')->willReturn($objectCollection);
        $this->configMock->expects($this->once())->method('getCapturedStateName')->willReturn('captured');
        $this->configMock->expects($this->once())->method('getEventName')->willReturn('event');
        $this->repositoryMock->expects($this->once())->method('getStateIdByName')->willReturn(11);
        $this->entityManagerMock->expects($this->once())->method('getOrdersByStateAndAge')->willReturn([$salesOrderMock]);
        $this->omsFacadeMock->expects($this->once())->method('triggerEvent')->willReturn([]);

        $responseTransferMock = $this->getMockBuilder(ExternalProcessingResponseTransfer::class)->getMock();
        $responseTransferMock->expects($this->once())->method('addProcessedOrder');
        $responseTransferMock->expects($this->never())->method('addFailedOrder');
        $this->processor->processCapturedOrders($responseTransferMock);
    }

    /**
     * @return void
     */
    public function testProcessCapturedOrdersError()
    {
        $this->markTestSkipped();
        $itemMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();
        $itemMock->expects($this->once())->method('getFkOmsOrderItemState')->willReturn(11);
        $objectCollection = new ObjectCollection([$itemMock]);
        $salesOrderMock = $this->getMockBuilder(SpySalesOrder::class)->disableOriginalConstructor()->getMock();
        $salesOrderMock->method('getItems')->willReturn($objectCollection);
        $this->repositoryMock->expects($this->once())->method('getStateIdByName')->willReturn(11);
        $this->entityManagerMock->expects($this->once())->method('getOrdersByStateAndAge')->willReturn([$salesOrderMock]);
        $this->omsFacadeMock->expects($this->once())->method('triggerEvent')->willReturn([]);

        $responseTransferMock = $this->getMockBuilder(ExternalProcessingResponseTransfer::class)->getMock();
        $responseTransferMock->expects($this->never())->method('addProcessedOrder');
        $responseTransferMock->expects($this->once())->method('addFailedOrder');

        $this->processor->processCapturedOrders($responseTransferMock);
    }
}
