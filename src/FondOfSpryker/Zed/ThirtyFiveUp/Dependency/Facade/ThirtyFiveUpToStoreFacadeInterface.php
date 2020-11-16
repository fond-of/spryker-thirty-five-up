<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Dependency\Facade;

interface ThirtyFiveUpToStoreFacadeInterface
{
    /**
     * @return string
     */
    public function getCurrentStoreName(): string;
}
