<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Reader;

use FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpReader implements ThirtyFiveUpReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface $repository
     */
    public function __construct(ThirtyFiveUpRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $orderReference
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByOrderReference(string $orderReference): ?ThirtyFiveUpOrderTransfer
    {
        return $this->repository->findThirtyFiveUpOrderByThirtyFiveUpReference($orderReference);
    }

    /**
     * @param string $thirtyFiveUpReference
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderByThirtyFiveUpReference(string $thirtyFiveUpReference): ?ThirtyFiveUpOrderTransfer
    {
        return $this->repository->findThirtyFiveUpOrderByOrderReference($thirtyFiveUpReference);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function findThirtyFiveUpOrderById(int $id): ?ThirtyFiveUpOrderTransfer
    {
        return $this->repository->findThirtyFiveUpOrderById($id);
    }


}
