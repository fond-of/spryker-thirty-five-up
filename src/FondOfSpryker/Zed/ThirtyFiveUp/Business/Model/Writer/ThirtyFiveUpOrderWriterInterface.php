<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Writer;

use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

interface ThirtyFiveUpOrderWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $orderTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function create(ThirtyFiveUpOrderTransfer $orderTransfer);

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $orderTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function update(ThirtyFiveUpOrderTransfer $orderTransfer);
}
