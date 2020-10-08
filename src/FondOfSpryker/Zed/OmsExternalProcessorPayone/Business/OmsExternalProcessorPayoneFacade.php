<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Business;

use Generated\Shared\Transfer\ExternalProcessingResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Business\OmsExternalProcessorPayoneBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface getRepository()
 */
class OmsExternalProcessorPayoneFacade extends AbstractFacade implements OmsExternalProcessorPayoneFacadeInterface
{
    public function process(ExternalProcessingResponseTransfer $externalProcessingResponseTransfer): ExternalProcessingResponseTransfer
    {
        return $this->getFactory()->createCompletelyCapturedProcessor()->processCapturedOrders($externalProcessingResponseTransfer);
    }
}
