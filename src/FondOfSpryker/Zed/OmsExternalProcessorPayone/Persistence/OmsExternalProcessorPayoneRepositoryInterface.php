<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence;

interface OmsExternalProcessorPayoneRepositoryInterface
{
    /**
     * @param string $name
     *
     * @throws \FondOfSpryker\Zed\OmsExternalProcessorPayone\Exception\OmsOrderItemStateNotFoundException
     *
     * @return int
     */
    public function getStateIdByName(string $name): int;
}
