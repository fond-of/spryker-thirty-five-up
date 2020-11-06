<?php

namespace FondOfSpryker\Zed\ThirtyFiveUp\Business;

use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Handler\ThirtyFiveUpOrderHandler;
use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Handler\ThirtyFiveUpOrderHandlerInterface;
use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapper;
use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface;
use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Reader\ThirtyFiveUpReader;
use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Reader\ThirtyFiveUpReaderInterface;
use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriter;
use FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface;
use FondOfSpryker\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * Class ThirtyFiveUpBusinessFactory
 *
 * @package FondOfSpryker\Zed\ThirtyFiveUp\Business
 *
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\ThirtyFiveUpConfig getConfig()
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface getEntityManager()()
 * @method \FondOfSpryker\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpRepositoryInterface getRepository()
 */
class ThirtyFiveUpBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Handler\ThirtyFiveUpOrderHandlerInterface
     */
    public function createThirtyFiveUpOrderHandler(): ThirtyFiveUpOrderHandlerInterface
    {
        return new ThirtyFiveUpOrderHandler(
            $this->createThirtyFiveUpOrderMapper(),
            $this->createThirtyFiveUpOrderWriter()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface
     */
    public function createThirtyFiveUpOrderMapper(): ThirtyFiveUpOrderMapperInterface
    {
        return new ThirtyFiveUpOrderMapper($this->getConfig(), $this->getLocaleFacade(), $this->getRepository());
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface
     */
    public function createThirtyFiveUpOrderWriter(): ThirtyFiveUpOrderWriterInterface
    {
        return new ThirtyFiveUpOrderWriter($this->getEntityManager());
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUp\Business\Model\Reader\ThirtyFiveUpReaderInterface
     */
    public function createThirtyFiveUpReader(): ThirtyFiveUpReaderInterface
    {
        return new ThirtyFiveUpReader($this->getRepository());
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUp\Dependency\Facade\ThirtyFiveUpToLocaleFacadeInterface
     */
    public function getLocaleFacade(): ThirtyFiveUpToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpDependencyProvider::FACADE_LOCALE);
    }
}
