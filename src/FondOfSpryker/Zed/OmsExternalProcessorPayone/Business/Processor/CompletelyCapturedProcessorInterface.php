<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Business\Processor;

use Generated\Shared\Transfer\ExternalProcessingResponseTransfer;

interface CompletelyCapturedProcessorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ExternalProcessingResponseTransfer $externalProcessingResponseTransfer
     *
     * @throws \FondOfSpryker\Zed\OmsExternalProcessorPayone\Exception\OmsOrderItemStateNotFoundException
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ExternalProcessingResponseTransfer
     */
    public function processCapturedOrders(ExternalProcessingResponseTransfer $externalProcessingResponseTransfer): ExternalProcessingResponseTransfer;
}
