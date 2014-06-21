<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Repository;

use Rey\Orm\EntityManagerInterface;
use Rey\Orm\Repository\RepositoryInterface;
use Rey\Orm\Exception\EntityNotFoundException;
use Rey\Orm\Exception\UnexpectedTypeException;
use Rey\Orm\Exception\RuntimeException;

/**
 * Class Factory repositories
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
interface RepositoryFactoryInterface
{
    /**
     * Set EntityManager for factory
     *
     * @param EntityManagerInterface $entityManager EntityManager
     *
     * @return  self
     *
     * @throws RuntimeException If entity manager was already set
     */
    public function setEntityManager(EntityManagerInterface $entityManager);

    /**
     * Get repository for entity
     *
     * @param  string $entityName Entity name
     *
     * @return RepositoryInterface
     *
     * @throws UnexpectedTypeException If an argument is not of the expected type
     * @throws EntityNotFoundException If an entity is not found
     * @throws RuntimeException If repository class not implement interface RepositoryInterface
     */
    public function getRepository($entityName);
}