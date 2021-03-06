<?php

declare (strict_types = 1);

namespace Dumplie\SharedKernel\Application\Extension\Command;

use Dumplie\SharedKernel\Application\Command\Command;
use Dumplie\SharedKernel\Application\Command\Extension;
use Dumplie\SharedKernel\Application\ServiceLocator;
use Dumplie\SharedKernel\Application\Transaction\Factory;
use Dumplie\SharedKernel\Application\Transaction\Transaction;

final class TransactionExtension implements Extension
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var Transaction|null
     */
    private $transaction;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Command $command
     * @return bool
     */
    public function expands(Command $command) : bool
    {
        return true;
    }

    /**
     * @param Command $command
     * @param ServiceLocator $serviceLocator
     */
    public function pre(Command $command, ServiceLocator $serviceLocator)
    {
        $this->transaction = $this->factory->open();
    }

    /**
     * @param Command $command
     * @param ServiceLocator $serviceLocator
     */
    public function post(Command $command, ServiceLocator $serviceLocator)
    {
        $this->transaction->commit();
    }

    /**
     * @param Command $command
     * @param \Exception $e
     * @param ServiceLocator $serviceLocator
     * @throws \Exception
     */
    public function catchException(Command $command, \Exception $e, ServiceLocator $serviceLocator)
    {
        $this->transaction->rollback();

        throw $e;
    }
}