<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests;

use Rey\Orm\Configuration;
use Rey\Orm\Configuration\ConfigurationInterface;
use Rey\Orm\Repository\RepositoryFactory;
use Rey\Orm\Repository\RepositoryFactoryInterface;
use Rey\Orm\Metadata\BitrixMetadataFactory;
use Rey\Orm\Tests\Fixtures\Repository\ExampleRepositoryFactory;
use Rey\Orm\Tests\Fixtures\Metadata\ExampleMetadataFactory;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Initialized Configuration object
     * @var ConfigurationInterface
     */
    protected $configurationTest;
    /**
     * Path to the temporary directory
     * @var string
     */
    protected $testPath;

    protected function setUp()
    {
        $this->configurationTest = new Configuration();

        $this->testPath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . time() . rand(0, 1000);
    }

    protected function tearDown()
    {
        $this->configurationTest = null;

        if (file_exists($this->testPath)) {
            chmod($this->testPath, 0777);
            rmdir($this->testPath);
        }
    }


    public function testFrozenConfiguration()
    {
        $this->assertFalse($this->configurationTest->isFrozen());

        $this->configurationTest->freeze();

        $this->assertTrue($this->configurationTest->isFrozen());
    }

    /**
     * @expectedException \Rey\Orm\Exception\InvalidConfigurationException
     */
    public function testSetDebugException()
    {
        $this->configurationTest->setDebug('string');
    }

    /**
     * @expectedException \Rey\Orm\Exception\FrozenConfigurationException
     */
    public function testSetDebugFrozenException()
    {
        $this->configurationTest->setDebug(true);

        $this->configurationTest->freeze();

        $this->configurationTest->setDebug(false);

    }

    public function testIsDebugDefaultValue()
    {
        $this->assertFalse($this->configurationTest->isDebug());
    }

    public function testSetAndGetDebugMode()
    {
        $this->configurationTest->setDebug(true);
        $this->assertTrue($this->configurationTest->isDebug());
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetRepositoryFactoryException()
    {
        $this->configurationTest->setRepositoryFactory(new \stdClass());
    }

    /**
     * @expectedException \Rey\Orm\Exception\FrozenConfigurationException
     */
    public function testSetRepositoryFactoryFrozenException()
    {
        $exampleRepositoryFactory = new ExampleRepositoryFactory();

        $this->configurationTest->setRepositoryFactory($exampleRepositoryFactory);

        $this->configurationTest->freeze();

        $this->configurationTest->setRepositoryFactory($exampleRepositoryFactory);

    }

    public function testGetRepositoryFactoryDefaultValue()
    {
        $this->assertTrue($this->configurationTest->getRepositoryFactory() == new RepositoryFactory());
    }

    public function testSetAndGetRepositoryFactory()
    {
        $exampleRepositoryFactory = new ExampleRepositoryFactory();

        $this->configurationTest->setRepositoryFactory($exampleRepositoryFactory);
        $this->assertTrue($this->configurationTest->getRepositoryFactory() === $exampleRepositoryFactory);
    }

    /**
     * @expectedException \Rey\Orm\Exception\InvalidConfigurationException
     */
    public function testSetBaseRepositoryClassException()
    {
        $this->configurationTest->setBaseRepositoryClass(array());
    }

    /**
     * @expectedException \Rey\Orm\Exception\FrozenConfigurationException
     */
    public function testSetBaseRepositoryClassFrozenException()
    {
        $exampleClassName = '\Example\ExampleBaseRepository';

        $this->configurationTest->setBaseRepositoryClass($exampleClassName);

        $this->configurationTest->freeze();

        $this->configurationTest->setBaseRepositoryClass($exampleClassName);

    }

    public function testGetBaseRepositoryClassDefaultValue()
    {
        $this->assertEquals($this->configurationTest->getBaseRepositoryClass(), '\Rey\Orm\Repository\BaseRepository');
    }

    public function testSetAndGetBaseRepositoryClass()
    {
        $exampleClassName = '\Example\ExampleBaseRepository';

        $this->configurationTest->setBaseRepositoryClass($exampleClassName);
        $this->assertEquals($this->configurationTest->getBaseRepositoryClass(), $exampleClassName);
    }

    /**
     * @expectedException \Rey\Orm\Exception\InvalidConfigurationException
     */
    public function testSetRepositoryClassExceptionForFirstParam()
    {
        $this->configurationTest->setRepositoryClass(false, 'string');
    }

    /**
     * @expectedException \Rey\Orm\Exception\InvalidConfigurationException
     */
    public function testSetRepositoryClassExceptionForSecondParam()
    {
        $this->configurationTest->setRepositoryClass('string', false);
    }

    /**
     * @expectedException \Rey\Orm\Exception\FrozenConfigurationException
     */
    public function testSetRepositoryClassFrozenException()
    {
        $exampleRepositoryClassName = '\Example\ExampleRepositoryClass';
        $exampleEntityName = 'TestEntityName';

        $this->configurationTest->setRepositoryClass($exampleEntityName, $exampleRepositoryClassName);

        $this->configurationTest->freeze();

        $this->configurationTest->setRepositoryClass($exampleEntityName, $exampleRepositoryClassName);
    }

    public function testSetAndGetRepositoryClass()
    {
        $exampleRepositoryClassName = '\Example\ExampleRepositoryClass';
        $exampleEntityName = 'TestEntityName';

        $this->assertTrue($this->configurationTest->getRepositoryClass('UnregisteredEntityName') === null);

        $this->configurationTest->setRepositoryClass($exampleEntityName, $exampleRepositoryClassName);
        $this->assertEquals($this->configurationTest->getRepositoryClass($exampleEntityName), $exampleRepositoryClassName);
    }

    /**
     * @expectedException \Rey\Orm\Exception\InvalidConfigurationException
     */
    public function testSetCacheDirException()
    {
        mkdir($this->testPath, 0000, true);

        $this->configurationTest->setCacheDir($this->testPath);
    }

    /**
     * @expectedException \Rey\Orm\Exception\FrozenConfigurationException
     */
    public function testSetCacheDirFrozenException()
    {
        mkdir($this->testPath, 0777, true);

        $this->configurationTest->setCacheDir($this->testPath);

        $this->configurationTest->freeze();

        $this->configurationTest->setCacheDir($this->testPath);
    }

    public function testGetCacheDirDefaultValue()
    {
        $this->assertTrue($this->configurationTest->getCacheDir() === null);
    }

    public function testSetAndGetCacheDir()
    {
        mkdir($this->testPath, 0777, true);

        $this->configurationTest->setCacheDir($this->testPath);

        $this->assertEquals($this->configurationTest->getCacheDir(), $this->testPath);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetMetadataFactoryException()
    {
        $this->configurationTest->setMetadataFactory(new \stdClass());
    }

    /**
     * @expectedException \Rey\Orm\Exception\FrozenConfigurationException
     */
    public function testSetMetadataFactoryFrozenException()
    {
        $exampleMetadataFactory = new ExampleMetadataFactory();

        $this->configurationTest->setMetadataFactory($exampleMetadataFactory);

        $this->configurationTest->freeze();

        $this->configurationTest->setMetadataFactory($exampleMetadataFactory);
    }


    public function testGetMetadataFactoryDefaultValue()
    {
        $this->assertTrue($this->configurationTest->getMetadataFactory() == new BitrixMetadataFactory());
    }

    public function testSetAndGetMetadataFactory()
    {
        $exampleMetadataFactory = new ExampleMetadataFactory();

        $this->configurationTest->setMetadataFactory($exampleMetadataFactory);
        $this->assertTrue($this->configurationTest->getMetadataFactory() === $exampleMetadataFactory);
    }

    /**
     * @expectedException \Rey\Orm\Exception\FrozenConfigurationException
     */
    public function testSetSiteIDFrozenException()
    {
        $this->configurationTest->setSiteID(array());

        $this->configurationTest->freeze();

        $this->configurationTest->setSiteID(array());

    }

    /**
     * @dataProvider siteIDInvalidValue
     * @expectedException \Rey\Orm\Exception\InvalidConfigurationException
     */
    public function testSetSiteIDInvalidValueException($value)
    {
        $this->configurationTest->setSiteID($value);
    }

    public function siteIDInvalidValue()
    {
        return array(
                array(false),
                array(1),
                array(0.1),
                array(null),
            );
    }

    public function testGetSiteIDDefaultValue()
    {
        $this->assertTrue($this->configurationTest->getSiteID() === array());
    }

    public function testGetSiteIDLogic()
    {
        $this->configurationTest->setSiteID('');
        $this->assertTrue($this->configurationTest->getSiteID() === array());

        $this->configurationTest->setSiteID('testSite');
        $this->assertTrue($this->configurationTest->getSiteID() === array('testSite'));

        $this->configurationTest->setSiteID(array());
        $this->assertTrue($this->configurationTest->getSiteID() === array());

        $this->configurationTest->setSiteID(array('site1', 'site2'));
        $this->assertTrue($this->configurationTest->getSiteID() === array('site1', 'site2'));
    }
}