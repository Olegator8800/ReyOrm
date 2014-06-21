<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Repository;

use Rey\Orm\EntityManagerInterface;
use Rey\Orm\Metadata\MetadataContainerInterface;

/**
 * Class base repository
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class BaseRepository implements RepositoryInterface
{
    /**
     * EntityManager
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Metadata
     * @var MetadataContainerInterface
     */
    private $metadata;

    /**
     * Initializes a new repository
     *
     * @param EntityManagerInterface $entityManager EntityManager
     * @param MetadataContainerInterface $metadata MetaData repository for entities
     */
    public function __construct(EntityManagerInterface $entityManager, MetadataContainerInterface $metadata)
    {
        $this->entityManager = $entityManager;
        $this->metadata = $metadata;
    }

    /**
     * Get Metadata container for the this repository
     *
     * @return MetadataContainerInterface Metadata container for the this repository
     */
    protected function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->metadata->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->metadata->getName();
    }
}