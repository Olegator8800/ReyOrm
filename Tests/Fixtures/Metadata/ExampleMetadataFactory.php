<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests\Fixtures\Metadata;

use Rey\Orm\Metadata\MetadataFactoryInterface;
use Rey\Orm\EntityManagerInterface;

class ExampleMetadataFactory implements MetadataFactoryInterface
{
    public function setEntityManager(EntityManagerInterface $entityManager)
    {

    }

    public function getEntityMetadata($entityName)
    {

    }
}