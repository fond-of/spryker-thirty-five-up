<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp;

use FondOfSpryker\Shared\ThirtyFiveUp\ThirtyFiveUpConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ThirtyFiveUpConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getKnownVendor(): array
    {
        return $this->get(ThirtyFiveUpConstants::KNOWN_VENDOR, []);
    }

    /**
     * @return string
     */
    public function getAttributeSkuSuffix(): string
    {
        return $this->get(ThirtyFiveUpConstants::SKU_SUFFIX, '_sku');
    }
}
