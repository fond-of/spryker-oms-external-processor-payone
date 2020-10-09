<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence;

use DateTime;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * Class OmsExternalProcessorPayoneEntityManager
 *
 * @package FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence
 *
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayonePersistenceFactory getFactory()
 */
class OmsExternalProcessorPayoneEntityManager extends AbstractEntityManager implements OmsExternalProcessorPayoneEntityManagerInterface
{
    /**
     * @param int $stateId
     * @param int|null $maxAgeInDays
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder[]
     */
    public function getOrdersByStateAndAge(int $stateId, ?int $maxAgeInDays = null): array
    {
        $query = $this->getFactory()->getSpySalesOrderQuery()->filterByIdItemState($stateId);
        if ($maxAgeInDays !== null) {
            $now = new DateTime();
            $past = new DateTime();
            $time = strtotime(sprintf('-%s days', $maxAgeInDays), $now->getTimestamp());
            $past->setTimestamp($time);
            $dateRange = [
                'min' => $past->format('Y-m-d H:i:s'),
                'max' => $now->format('Y-m-d H:i:s'),
            ];
            $query->filterByCreatedAt_Between($dateRange);
        }

        return $query->find()->getData();
    }
}
