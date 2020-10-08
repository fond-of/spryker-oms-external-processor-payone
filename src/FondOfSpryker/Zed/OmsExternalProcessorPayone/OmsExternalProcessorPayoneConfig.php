<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone;

use FondOfSpryker\Shared\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class OmsExternalProcessorPayoneConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getCapturedStateName(): string
    {
        return $this->get(
            OmsExternalProcessorPayoneConstants::CAPTURED_STATE_NAME,
            OmsExternalProcessorPayoneConstants::CAPTURED_STATE_NAME_DEFAULT
        );
    }

    /**
     * @return int
     */
    public function getMaxAgeInDays(): int
    {
        return $this->get(
            OmsExternalProcessorPayoneConstants::MAX_AGE_IN_DAYS,
            OmsExternalProcessorPayoneConstants::MAX_AGE_IN_DAYS_DEFAULT
        );
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->get(
            OmsExternalProcessorPayoneConstants::EVENT_NAME,
            OmsExternalProcessorPayoneConstants::EVENT_NAME_DEFAULT
        );
    }
}
