<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Persistence;

use FondOfSpryker\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapperInterface;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpPersistenceFactory getFactory()
 */
class ThirtyFiveUpRepository extends AbstractRepository implements ThirtyFiveUpRepositoryInterface
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapperInterface
     */
    protected $mapper;

    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery
     */
    protected $orderQuery;

    /**
     * @param string $orderReference
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByOrderReference(string $orderReference): ?ThirtyFiveUpOrderTransfer
    {
        $entity = $this->getOrderQuery()->findOneByOrderReference($orderReference);

        if ($entity === null) {
            return null;
        }

        return $this->convertOrderEntityToTransfer($entity);
    }

    /**
     * @param string $thirtyFiveUpReference
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByThirtyFiveUpReference(string $thirtyFiveUpReference): ?ThirtyFiveUpOrderTransfer
    {
        $entity = $this->getOrderQuery()->findOneByOrderReference($thirtyFiveUpReference);

        if ($entity === null) {
            return null;
        }

        return $this->convertOrderEntityToTransfer($entity);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderById(int $id): ?ThirtyFiveUpOrderTransfer
    {
        $entity = $this->getOrderQuery()->findOneByIdThirtyFiveUpOrder($id);

        if ($entity === null) {
            return null;
        }

        return $this->convertOrderEntityToTransfer($entity);
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function convertOrderEntityToTransfer(ThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer
    {
        return $this->getMapper()->mapOrderFromEntity($thirtyFiveUpOrder);
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\Propel\Mapper\ThirtyFiveUpEntityMapperInterface
     */
    protected function getMapper(): ThirtyFiveUpEntityMapperInterface
    {
        if ($this->mapper === null) {
            $this->mapper = $this->getFactory()->createThirtyFiveUpEntityMapper();
        }

        return $this->mapper;
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery
     */
    protected function getOrderQuery(): ThirtyFiveUpOrderQuery
    {
        if ($this->orderQuery === null) {
            $this->orderQuery = $this->getFactory()->createThirtyFiveUpOrderQuery();
        }

        return $this->orderQuery;
    }
}
