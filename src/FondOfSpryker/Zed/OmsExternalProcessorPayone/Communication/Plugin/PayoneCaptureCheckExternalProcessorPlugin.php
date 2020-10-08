<?php

namespace  FondOfSpryker\Zed\OmsExternalProcessorPayone\Communication\Plugin;

use FondOfSpryker\Zed\OmsExternalProcessor\Dependency\Plugin\ExternalProcessorPluginInterface;
use Generated\Shared\Transfer\ExternalProcessingResponseTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Class PayoneCaptureCheckExternalProcessorPlugin
 *
 * @package FondOfSpryker\Zed\OmsExternalProcessorPayone\Communication\Plugin
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Business\OmsExternalProcessorPayoneFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig getConfig()
 */
class PayoneCaptureCheckExternalProcessorPlugin extends AbstractPlugin implements ExternalProcessorPluginInterface
{
    public const NAME = 'PayoneCaptureCheckExternalProcessorPlugin';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param \Generated\Shared\Transfer\ExternalProcessingResponseTransfer $externalProcessingResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ExternalProcessingResponseTransfer
     */
    public function process(ExternalProcessingResponseTransfer $externalProcessingResponseTransfer): ExternalProcessingResponseTransfer
    {
        return $this->getFacade()->process($externalProcessingResponseTransfer);
    }
}
