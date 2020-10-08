<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence;

use FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneDependencyProvider;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig getConfig()
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\Persistence\OmsExternalProcessorPayoneRepositoryInterface getRepository()
 */
class OmsExternalProcessorPayonePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery
     */
    public function getSpyOmsOrderItemStateQuery(): SpyOmsOrderItemStateQuery
    {
        return $this->getProvidedDependency(OmsExternalProcessorPayoneDependencyProvider::QUERY_OMS_ORDER_ITEM_STATE);
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery
     */
    public function getSpySalesOrderQuery(): SpySalesOrderQuery
    {
        return $this->getProvidedDependency(OmsExternalProcessorPayoneDependencyProvider::QUERY_SALES_ORDER);
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery
     */
    public function getSpySalesOrderItemQuery(): SpySalesOrderItemQuery
    {
        return $this->getProvidedDependency(OmsExternalProcessorPayoneDependencyProvider::QUERY_SALES_ORDER_ITEM);
    }
}
