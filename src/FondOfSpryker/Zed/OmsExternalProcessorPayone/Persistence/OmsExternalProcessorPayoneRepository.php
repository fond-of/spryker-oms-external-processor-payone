<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence;

use FondOfSpryker\Zed\OmsExternalProcessorPayone\Exception\OmsOrderItemStateNotFoundException;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * Class OmsExternalProcessorPayoneRepository
 *
 * @package FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence
 *
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayonePersistenceFactory getFactory()
 */
class OmsExternalProcessorPayoneRepository extends AbstractRepository implements OmsExternalProcessorPayoneRepositoryInterface
{
    /**
     * @param string $name
     *
     * @throws \FondOfSpryker\Zed\OmsExternalProcessorPayone\Exception\OmsOrderItemStateNotFoundException
     *
     * @return int
     */
    public function getStateIdByName(string $name): int
    {
        $query = $this->getFactory()->getSpyOmsOrderItemStateQuery();
        $state = $query->findOneByName($name);
        if ($state === null) {
            throw new OmsOrderItemStateNotFoundException(sprintf('State with name %s not found!', $name));
        }

        return $state->getIdOmsOrderItemState();
    }
}
