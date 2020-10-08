<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Business;

use Generated\Shared\Transfer\ExternalProcessingResponseTransfer;

interface OmsExternalProcessorPayoneFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ExternalProcessingResponseTransfer $externalProcessingResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ExternalProcessingResponseTransfer
     */
    public function process(ExternalProcessingResponseTransfer $externalProcessingResponseTransfer): ExternalProcessingResponseTransfer;
}
