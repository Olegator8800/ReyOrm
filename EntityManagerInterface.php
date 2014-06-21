<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm;

use Rey\Orm\Configuration\ConfigurationInterface;
use Rey\Orm\Metadata\MetadataFactoryInterface;
use Rey\Orm\Repository\RepositoryInterface;

/**
 * Interface for EntityManager
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
interface EntityManagerInterface
{
    /**
     * Get EntityManager configuration
     *
     * @return ConfigurationInterface EntityManager configuration
     */
    public function getConfiguration();

    /**
     * Get Metadata Factory
     *
     * @return MetadataFactoryInterface Metadata Factory
     */
    public function getMetadataFactory();

    /**
     * Get repository for entity
     *
     * @param  string $entityName Entity name
     *
     * @return RepositoryInterface
     */
    public function getRepository($entityName);
}