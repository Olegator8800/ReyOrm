<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm;

use Rey\Orm\Configuration\ConfigurationInterface;
use Rey\Orm\Repository\RepositoryFactory;
use Rey\Orm\Repository\RepositoryFactoryInterface;
use Rey\Orm\Metadata\MetadataFactoryInterface;

/**
 * Class EntityManager manages entities and repositories
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class EntityManager implements EntityManagerInterface
{
    /**
     * Used configuration
     * @var ConfigurationInterface
     */
    protected $config;

    /**
     * RepositoryFactory used to create repositories
     * @var RepositoryFactoryInterface
     */
    protected $repositoryFactory;

    /**
     * MetadataFactory used to getting information about entities
     * @var MetadataFactoryInterface
     */
    protected $metadataFactory;

    /**
     * Initialize EntityManager
     *
     * @param ConfigurationInterface $config EntityManager parameters
     */
    public function __construct(ConfigurationInterface $config)
    {
        //make read only configuration
        $config->freeze();

        $this->config = $config;

        $this->repositoryFactory = $config->getRepositoryFactory();
        $this->repositoryFactory->setEntityManager($this);

        $this->metadataFactory = $config->getMetadataFactory();
        $this->metadataFactory->setEntityManager($this);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        return $this->config;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadataFactory()
    {
        return $this->metadataFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getRepository($entityName)
    {
        return $this->repositoryFactory->getRepository($entityName);
    }
}