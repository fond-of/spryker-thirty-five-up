<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Communication\Plugin\Sales;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface;

/**
 * Class UpdateThirtyFiveUpOrderAfterPostSaveOrderExpanderPlugin
 *
 * @package FondOfSpryker\Zed\ThirtyFiveUp\Communication\Plugin\Sales
 *
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 */
class UpdateThirtyFiveUpOrderAfterPostSaveOrderExpanderPlugin extends AbstractPlugin implements OrderPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function execute(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        $thirtyFiveUpOrder = $quoteTransfer->getThirtyFiveUpOrder();
        if ($thirtyFiveUpOrder !== null) {
            $this->getFacade()->addAndSaveOrderDataFromSaveOrderTransfer($saveOrderTransfer, $thirtyFiveUpOrder);
        }

        return $saveOrderTransfer;
    }
}
