<?php


namespace FondOfSpryker\Zed\ThirtyFiveUp\Communication\Plugin\Sales;


use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemExpanderPreSavePluginInterface;

/**
 * Class AddThirtyFiveUpDataToSalesOrderItemExpanderPreSavePlugin
 * @package FondOfSpryker\Zed\ThirtyFiveUp\Communication\Plugin\Sales
 *
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 */
class AddThirtyFiveUpDataToSalesOrderItemExpanderPreSavePlugin extends AbstractPlugin implements OrderItemExpanderPreSavePluginInterface
{
    /**
     * @param  \Generated\Shared\Transfer\QuoteTransfer  $quoteTransfer
     * @param  \Generated\Shared\Transfer\ItemTransfer  $itemTransfer
     * @param  \Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer  $salesOrderItemEntity
     *
     * @return \Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer
     */
    public function expandOrderItem(
        QuoteTransfer $quoteTransfer,
        ItemTransfer $itemTransfer,
        SpySalesOrderItemEntityTransfer $salesOrderItemEntity
    ): SpySalesOrderItemEntityTransfer {
        $thirtyFiveUpOrder = $quoteTransfer->getThirtyFiveUpOrder();

        if ($thirtyFiveUpOrder !== null){
            foreach ($thirtyFiveUpOrder->getItems() as $thirtyFiveUpOrderItemTransfer){
                if ($salesOrderItemEntity->getSku() === $thirtyFiveUpOrderItemTransfer->getShopSku()){
                    $salesOrderItemEntity->setVendor($thirtyFiveUpOrderItemTransfer->getVendor()->getName());
                    $salesOrderItemEntity->setVendorSku($thirtyFiveUpOrderItemTransfer->getSku());
                    return $salesOrderItemEntity;
                }
            }
        }

        return $salesOrderItemEntity;
    }

}