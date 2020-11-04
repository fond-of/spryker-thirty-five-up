<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ThirtyFiveUpFacade
 *
 * @package FondOfSpryker\Zed\ThirtyFiveUp\Business
 *
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Business\ThirtyFiveUpBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface getRepository()
 */
class ThirtyFiveUpFacade extends AbstractFacade implements ThirtyFiveUpFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function createThirtyFiveUpOrderFromQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createThirtyFiveUpOrderHandler()->handleFromQuote($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function addAndSaveOrderDataFromSaveOrderTransfer(
        SaveOrderTransfer $saveOrderTransfer,
        ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
    ): ThirtyFiveUpOrderTransfer {
        return $this->getFactory()->createThirtyFiveUpOrderHandler()->handleFromSavedOrder(
            $saveOrderTransfer,
            $thirtyFiveUpOrderTransfer
        );
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function convertThirtyFiveUpOrderEntityToTransfer(ThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer
    {
        return $this->getFactory()->createThirtyFiveUpOrderMapper()->fromEntity($thirtyFiveUpOrder);
    }
}
