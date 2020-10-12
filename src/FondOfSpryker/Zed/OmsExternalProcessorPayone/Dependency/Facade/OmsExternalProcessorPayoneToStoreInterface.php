<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface OmsExternalProcessorPayoneToStoreInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
