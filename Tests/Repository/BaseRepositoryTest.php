<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests\Repository;

use Rey\Orm\Repository\BaseRepository;
use Rey\Orm\Tests\Fixtures\ExampleEntityManager;
use Rey\Orm\Metadata\MetadataContainer;
use ReflectionClass;

class BaseRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Initialized BaseRepository object
     * @var BaseRepository
     */
    protected $baseRepositoryTest;

    /**
     * Initialized MetadataContainer object
     * @var MetadataContainer
     */
    protected $metadataContainerSimple;

    protected $metaNameTest;
    protected $metaTypeTest;
    protected $metaDataTest;

    protected function setUp()
    {
        $em = new ExampleEntityManager();

        $this->metaNameTest = 'testEntityName';
        $this->metaTypeTest = 'testEntityType';
        $this->metaDataTest = array('id' => 1);

        $this->metadataContainerSimple = new MetadataContainer($this->metaNameTest, $this->metaTypeTest, $this->metaDataTest);

        $this->baseRepositoryTest = new BaseRepository($em, $this->metadataContainerSimple);
    }

    protected function tearDown()
    {
        $this->baseRepositoryTest = null;
        $this->metadataContainerSimple = null;

        $this->metaNameTest = null;
        $this->metaTypeTest = null;
        $this->metaDataTest = null;
    }

    public function testGetType()
    {
        $this->assertEquals($this->baseRepositoryTest->getType(), $this->metaTypeTest);
    }

    public function testGetName()
    {
        $this->assertEquals($this->baseRepositoryTest->getName(), $this->metaNameTest);
    }
}