<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Business\Processor;

use Exception;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsInterface;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface;
use Generated\Shared\Transfer\ExternalProcessingOrderTransfer;
use Generated\Shared\Transfer\ExternalProcessingResponseTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Log\LoggerTrait;

class CompletelyCapturedProcessor implements CompletelyCapturedProcessorInterface
{
    use LoggerTrait;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsInterface
     */
    protected $omsFacade;

    /**
     * @var \FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface $entityManager
     * @param \FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsInterface $omsFacade
     * @param \FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig $config
     */
    public function __construct(
        OmsExternalProcessorPayoneRepositoryInterface $repository,
        OmsExternalProcessorPayoneEntityManagerInterface $entityManager,
        OmsExternalProcessorPayoneToOmsInterface $omsFacade,
        OmsExternalProcessorPayoneConfig $config
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->omsFacade = $omsFacade;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ExternalProcessingResponseTransfer $externalProcessingResponseTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ExternalProcessingResponseTransfer
     */
    public function processCapturedOrders(ExternalProcessingResponseTransfer $externalProcessingResponseTransfer): ExternalProcessingResponseTransfer
    {
        $stateId = $this->repository->getStateIdByName($this->config->getCapturedStateName());
        $orders = $this->entityManager->getOrdersByStateAndAge($stateId, $this->config->getMaxAgeInDays());

        foreach ($orders as $order) {
            if ($this->validateAllItemsInCorrectState($order, $stateId)) {
                $statusResponse = new ExternalProcessingOrderTransfer();
                $statusResponse
                    ->setSuccess(false)
                    ->setOrderId($order->getIdSalesOrder())
                    ->setOrderReference($order->getOrderReference());
                try {
                    $items = $order->getItems();
                    $status = $this->omsFacade->triggerEvent(
                        $this->config->getEventName(),
                        $items,
                        []
                    );

                    if ($status !== null) {
                        $statusResponse->setSuccess(true);
                        $externalProcessingResponseTransfer->addProcessedOrder($statusResponse);

                        continue;
                    }

                    throw new Exception('internal oms failure');
                } catch (Exception $exception) {
                    $statusResponse->setError($exception->getMessage());
                    $statusResponse->setSuccess(false);
                    $this->getLogger()->error(sprintf('Try to process order with id %s. Error message: %s', $order->getIdSalesOrder(), $exception->getMessage()), $exception->getTrace());
                    $externalProcessingResponseTransfer->addFailedOrder($statusResponse);
                }
            }
        }

        return $externalProcessingResponseTransfer;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $order
     * @param int $stateId
     *
     * @return bool
     */
    protected function validateAllItemsInCorrectState(
        SpySalesOrder $order,
        int $stateId
    ): bool {
        foreach ($order->getItems() as $orderItem) {
            if ($orderItem->getFkOmsOrderItemState() !== $stateId) {
                return false;
            }
        }

        return true;
    }
}
