<?php

namespace FondOfSpryker\Shared\OmsExternalProcessorPayone;

interface OmsExternalProcessorPayoneConstants
{
    public const CAPTURED_STATE_NAME = 'OMS:EXTERNAL:PROCESSOR:PAYONE:CAPTURED_STATE_NAME';
    public const CAPTURED_STATE_NAME_DEFAULT = 'captured';
    public const MAX_AGE_IN_DAYS = 'OMS:EXTERNAL:PROCESSOR:PAYONE:MAX_AGE_IN_DAYS';
    public const MAX_AGE_IN_DAYS_DEFAULT = 7;
    public const EVENT_NAME = 'OMS:EXTERNAL:PROCESSOR:PAYONE:EVENT_NAME';
    public const EVENT_NAME_DEFAULT = 'send order confirmation';
}
