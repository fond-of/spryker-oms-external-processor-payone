<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence;

use Codeception\Test\Unit;
use Exception;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemState;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery;

/**
 * Auto-generated group annotations
 *
 * @group FondOfSpryker
 * @group Zed
 * @group OmsExternalProcessorPayone
 * @group Persistence
 * @group OmsExternalProcessorPayoneRepositoryTest
 * Add your own group annotations below this line
 */
class OmsExternalProcessorPayoneRepositoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayonePersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyOmsOrderItemStateQueryMock;

    /**
     * @var \Orm\Zed\Oms\Persistence\SpyOmsOrderItemState|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyOmsOrderItemStateMock;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface
     */
    protected $repository;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->spyOmsOrderItemStateQueryMock = $this->getMockBuilder(SpyOmsOrderItemStateQuery::class)->addMethods(['findOneByName'])->getMock();
        $this->spyOmsOrderItemStateMock = $this->getMockBuilder(SpyOmsOrderItemState::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(OmsExternalProcessorPayonePersistenceFactory::class)->disableOriginalConstructor()->getMock();
        $this->repository = new OmsExternalProcessorPayoneRepository();
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetStateIdByName()
    {
        $this->factoryMock->expects($this->once())->method('getSpyOmsOrderItemStateQuery')->willReturn($this->spyOmsOrderItemStateQueryMock);
        $this->spyOmsOrderItemStateQueryMock->expects($this->once())->method('findOneByName')->willReturn($this->spyOmsOrderItemStateMock);
        $this->spyOmsOrderItemStateMock->expects($this->once())->method('getIdOmsOrderItemState')->willReturn(1);

        $this->repository->getStateIdByName('test');
    }

    /**
     * @return void
     */
    public function testGetStateIdByNameException()
    {
        $this->factoryMock->expects($this->once())->method('getSpyOmsOrderItemStateQuery')->willReturn($this->spyOmsOrderItemStateQueryMock);
        $this->spyOmsOrderItemStateQueryMock->expects($this->once())->method('findOneByName')->willReturn(null);
        $this->spyOmsOrderItemStateMock->expects($this->never())->method('getIdOmsOrderItemState');

        $catch = null;
        try {
            $this->repository->getStateIdByName('test');
        } catch (Exception $exception) {
            $catch = $exception;
        }
        $this->assertSame('State with name test not found!', $catch->getMessage());
    }
}
