<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Metadata;

use Rey\Orm\EntityManagerInterface;
use Rey\Orm\Metadata\MetadataContainerInterface;
use Rey\Orm\Exception\RuntimeException;
use Rey\Orm\Exception\EntityNotFoundException;

/**
 * Interface for Metadata Factory
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
interface MetadataFactoryInterface
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
     * Get metadata for entity
     *
     * @param  string $entityName Entity name
     *
     * @return boolean|MetadataContainerInterface False if not found of metadata or data container
     *
     * @throws EntityNotFoundException If an entity is not found
     */
    public function getEntityMetadata($entityName);
}