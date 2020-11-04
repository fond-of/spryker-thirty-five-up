<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Mapper;

use ArrayObject;
use FondOfSpryker\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;

class ThirtyFiveUpOrderMapper implements ThirtyFiveUpOrderMapperInterface
{
    protected const FALLBACK_LOCALE = '_';

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpConfig
     */
    protected $config;

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpConfig $config
     * @param \FondOfSpryker\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface $localeFacade
     */
    public function __construct(ThirtyFiveUpConfig $config, ThirtyFiveUpToLocaleFacadeInterface $localeFacade)
    {
        $this->config = $config;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ?ThirtyFiveUpOrderTransfer
    {
        $thirtyFiveUpItems = $this->resolveThirtyFiveUpItems($quoteTransfer);

        if (count($thirtyFiveUpItems) === 0) {
            return null;
        }

        $thirtyFiveUpOrder = new ThirtyFiveUpOrderTransfer();
        foreach ($thirtyFiveUpItems as $itemTransfer) {
            $thirtyFiveUpOrder->addItem($itemTransfer);
        }

        return $thirtyFiveUpOrder;
    }

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function fromSavedOrder(
        SaveOrderTransfer $saveOrderTransfer,
        ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
    ): ThirtyFiveUpOrderTransfer {
        $thirtyFiveUpOrderTransfer
            ->setOrderReference($saveOrderTransfer->getOrderReference())
            ->setSalesOrderId($saveOrderTransfer->getIdSalesOrder());

        return $thirtyFiveUpOrderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer[]
     */
    protected function resolveThirtyFiveUpItems(QuoteTransfer $quoteTransfer): array
    {
        $thirtyFiveUpItems = [];
        $knownVendor = $this->config->getKnownVendor();
        $defaultLocale = $this->localeFacade->getCurrentLocaleName();
        foreach ($this->groupItems($quoteTransfer->getItems()) as $itemTransfer) {
            $attributes = $itemTransfer->getAbstractAttributes();

            if (array_key_exists($defaultLocale, $attributes)) {
                $thirtyFiveUpItems = $this->getItemFromAttributes(
                    $attributes[$defaultLocale],
                    $knownVendor,
                    $thirtyFiveUpItems,
                    $itemTransfer
                );
            }
            if (array_key_exists(static::FALLBACK_LOCALE, $attributes)) {
                $thirtyFiveUpItems = $this->getItemFromAttributes(
                    $attributes[static::FALLBACK_LOCALE],
                    $knownVendor,
                    $thirtyFiveUpItems,
                    $itemTransfer
                );
            }
        }

        return $thirtyFiveUpItems;
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $items
     *
     * @return \Generated\Shared\Transfer\ItemTransfer[]
     */
    protected function groupItems(ArrayObject $items): array
    {
        /** @var \Generated\Shared\Transfer\ItemTransfer[] $groupedItems */
        $groupedItems = [];
        foreach ($items as $itemTransfer) {
            $sku = $itemTransfer->getSku();
            if (array_key_exists($sku, $groupedItems)) {
                $groupedItems[$sku]->setQuantity($itemTransfer->getQuantity() + $groupedItems[$sku]->getQuantity());

                continue;
            }

            $groupedItems[$sku] = clone $itemTransfer;
        }

        return $groupedItems;
    }

    /**
     * @param string $vendorName
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer
     */
    protected function mapVendor(string $vendorName): ThirtyFiveUpVendorTransfer
    {
        return (new ThirtyFiveUpVendorTransfer())
            ->setName($vendorName);
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    protected function stringEndsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);
        if ($length === 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    /**
     * @param string $value
     * @param string $vendor
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer
     */
    protected function mapOrderItem(
        string $value,
        string $vendor,
        ItemTransfer $itemTransfer
    ): ThirtyFiveUpOrderItemTransfer {
        return $thirtyFiveUpItem = (new ThirtyFiveUpOrderItemTransfer())
            ->setSku($value)
            ->setQty($itemTransfer->getQuantity())
            ->setVendor($this->mapVendor($vendor));
    }

    /**
     * @param array $attributes
     * @param array $knownVendor
     * @param array $thirtyFiveUpItems
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return array
     */
    protected function getItemFromAttributes(
        array $attributes,
        array $knownVendor,
        array $thirtyFiveUpItems,
        ItemTransfer $itemTransfer
    ): array {
        foreach ($attributes as $attributeName => $attributeValue) {
            if (
                $this->stringEndsWith(
                    $attributeName,
                    $this->config->getAttributeSkuPrefix()
                ) && in_array(
                    str_replace($this->config->getAttributeSkuPrefix(), '', $attributeName),
                    $knownVendor
                )
            ) {
                $check = sprintf('%s|%s', $itemTransfer->getFkSalesOrderItem(), $attributeValue);
                if (array_key_exists($check, $thirtyFiveUpItems) === true) {
                    return $thirtyFiveUpItems;
                }

                $vendor = str_replace($this->config->getAttributeSkuPrefix(), '', $attributeName);
                $thirtyFiveUpItems[$check] = $this->mapOrderItem($attributeValue, $vendor, $itemTransfer);

                return $thirtyFiveUpItems;
            }
        }

        return $thirtyFiveUpItems;
    }
}
