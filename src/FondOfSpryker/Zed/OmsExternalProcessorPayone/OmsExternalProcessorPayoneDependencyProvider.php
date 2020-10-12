<?php

namespace FondOfSpryker\Zed\OmsExternalProcessorPayone;

use FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToOmsBridge;
use FondOfSpryker\Zed\OmsExternalProcessorPayone\Dependency\Facade\OmsExternalProcessorPayoneToStoreBridge;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemStateQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfSpryker\Zed\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConfig getConfig()
 */
class OmsExternalProcessorPayoneDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_OMS_ORDER_ITEM_STATE = 'QUERY_OMS_ORDER_ITEM_STATE';
    public const QUERY_SALES_ORDER_ITEM = 'QUERY_SALES_ORDER_ITEM';
    public const QUERY_SALES_ORDER = 'QUERY_SALES_ORDER';
    public const FACADE_OMS = 'FACADE_OMS';
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = $this->addSpyOmsOrderItemQueryQuery($container);
        $container = $this->addSpySalesOrderQuery($container);
        $container = $this->addSpySalesOrderItemQuery($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addOmsFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpyOmsOrderItemQueryQuery(Container $container): Container
    {
        $container[static::QUERY_OMS_ORDER_ITEM_STATE] = static function () {
            return SpyOmsOrderItemStateQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpySalesOrderItemQuery(Container $container): Container
    {
        $container[static::QUERY_SALES_ORDER_ITEM] = static function () {
            return SpySalesOrderItemQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpySalesOrderQuery(Container $container): Container
    {
        $container[static::QUERY_SALES_ORDER] = static function () {
            return SpySalesOrderQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOmsFacade(Container $container)
    {
        $container->set(static::FACADE_OMS, function (Container $container) {
            return new OmsExternalProcessorPayoneToOmsBridge($container->getLocator()->oms()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container)
    {
        $container->set(static::FACADE_STORE, function (Container $container) {
            return new OmsExternalProcessorPayoneToStoreBridge($container->getLocator()->store()->facade());
        });

        return $container;
    }
}
