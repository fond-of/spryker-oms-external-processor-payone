<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Business;

use FondOfSpryker\Zed\OmsExternalProcessorPayone\Business\Processor\CompletelyCapturedProcessor;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsInterface;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig getConfig()
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManager getEntityManager()
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepository getRepository()
 */
class OmsExternalProcessorPayoneBusinessFactory extends AbstractBusinessFactory
{
    public function createCompletelyCapturedProcessor()
    {
        return new CompletelyCapturedProcessor(
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getOmsFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsInterface
     */
    public function getOmsFacade(): OmsExternalProcessorPayoneToOmsInterface
    {
        return $this->getProvidedDependency(OmsExternalProcessorPayoneDependencyProvider::FACADE_OMS);
    }
}
