<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests;

use Rey\Orm\EntityManager;
use Rey\Orm\Configuration;
use Rey\Orm\Configuration\ConfigurationInterface;
use Rey\Orm\Metadata\MetadataFactoryInterface;
use Rey\Orm\Tests\Fixtures\Repository\ExampleRepositoryFactory;

class EntityManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $testEntityManager;

    protected function setUp()
    {
        $standartConfiguration = new Configuration();

        $this->testEntityManager = new EntityManager($standartConfiguration);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testEntityManagerInitializationException()
    {
        $testEntityManager = new EntityManager(new \stdClass());
    }

    public function testGetConfiguration()
    {
        $this->assertTrue($this->testEntityManager->getConfiguration() instanceof ConfigurationInterface);
    }

    public function testGetMetadataFactory()
    {
        $this->assertTrue($this->testEntityManager->getMetadataFactory() instanceof MetadataFactoryInterface);
    }

    public function testGetRepository()
    {
        $exampleEnitiyName = 'News';
        $exampleRepositoryFactory = new ExampleRepositoryFactory();

        $testConfig = new Configuration();
        $testConfig->setRepositoryFactory($exampleRepositoryFactory);

        $testEntityManager = new EntityManager($testConfig);

        $this->assertEquals($testEntityManager->getRepository($exampleEnitiyName), 'RepositoryFor' . $exampleEnitiyName);
    }
}