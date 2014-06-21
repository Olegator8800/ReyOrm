<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Repository;

use Rey\Orm\EntityManagerInterface;
use Rey\Orm\Exception\EntityNotFoundException;
use Rey\Orm\Exception\UnexpectedTypeException;
use Rey\Orm\Exception\RuntimeException;
use Rey\Orm\Repository\RepositoryInterface;

/**
 * Class Factory repositories
 * Contains the logic for creating repositories for entities
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class RepositoryFactory implements RepositoryFactoryInterface
{
    /**
     * EntityManager
     * @var EntityManagerInterface
     */
    protected $entityManager = null;

    /**
     * List created repository instances
     * @var array
     */
    protected $repositoryList = array();

    /**
     * {@inheritdoc}
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        if ($this->entityManager !== null) {
            throw new RuntimeException('EntityManager was already set');
        }

        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRepository($entityName)
    {
        if (!is_string($entityName)) {
            throw new UnexpectedTypeException($entityName, 'string');
        }

        if (isset($this->repositoryList[$entityName])) {
            return $this->repositoryList[$entityName];
        }

        $repository = $this->createRepository($entityName);

        $this->repositoryList[$entityName] = $repository;

        return $repository;
    }

    /**
     * Create repository for entity
     *
     * @param  $entityName $entityName Entity name
     *
     * @return RepositoryInterface Repository instance
     */
    protected function createRepository($entityName)
    {
        $config = $this->entityManager->getConfiguration();
        $metadataFactory = $this->entityManager->getMetadataFactory();

        $metaData = $metadataFactory->getEntityMetadata($entityName);

        $repositoryClass = $config->getRepositoryClass($entityName) !== null
                            ?   $config->getRepositoryClass($entityName)
                            :   $config->getBaseRepositoryClass();

        $repository = new $repositoryClass($this->entityManager, $metaData);

        if (!($repository instanceof RepositoryInterface)) {
            $interfaceName = 'Rey\Orm\Repository\RepositoryInterface';
            throw new RuntimeException(sprintf('Repository class "%s", declared for the entity "%s" must implement interface %s', get_class($repository), $entityName, $interfaceName));
        }

        return $repository;
    }
}