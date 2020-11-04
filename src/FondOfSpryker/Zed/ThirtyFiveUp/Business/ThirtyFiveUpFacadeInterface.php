<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

interface ThirtyFiveUpFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function createThirtyFiveUpOrderFromQuote(QuoteTransfer $quoteTransfer): QuoteTransfer;

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function addAndSaveOrderDataFromSaveOrderTransfer(
        SaveOrderTransfer $saveOrderTransfer,
        ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
    ): ThirtyFiveUpOrderTransfer;
}
