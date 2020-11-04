<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Writer;

use FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpOrderWriter implements ThirtyFiveUpOrderWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface $entityManager
     */
    public function __construct(ThirtyFiveUpEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function create(ThirtyFiveUpOrderTransfer $orderTransfer)
    {
        return $this->entityManager->createThirtyFiveUpOrder($orderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function update(ThirtyFiveUpOrderTransfer $orderTransfer)
    {
        return $this->entityManager->updateThirtyFiveUpOrder($orderTransfer);
    }
}
