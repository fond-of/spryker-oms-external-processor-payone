<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence;

interface OmsExternalProcessorPayoneEntityManagerInterface
{
    /**
     * @param int $stateId
     * @param int|null $maxAgeInDays
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder[]
     */
    public function getOrdersByStateAndAge(int $stateId, ?int $maxAgeInDays = null): array;
}
