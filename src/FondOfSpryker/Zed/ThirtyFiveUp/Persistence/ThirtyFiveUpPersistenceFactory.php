<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Persistence;

use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItemQuery;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpVendorQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface getRepository()
 */
class ThirtyFiveUpPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery
     */
    public function createThirtyFiveUpOrderQuery(): ThirtyFiveUpOrderQuery
    {
        return ThirtyFiveUpOrderQuery::create();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItemQuery
     */
    public function createThirtyFiveUpOrderItemQuery(): ThirtyFiveUpOrderItemQuery
    {
        return ThirtyFiveUpOrderItemQuery::create();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpVendorQuery
     */
    public function createThirtyFiveUpVendorQuery(): ThirtyFiveUpVendorQuery
    {
        return ThirtyFiveUpVendorQuery::create();
    }
}
