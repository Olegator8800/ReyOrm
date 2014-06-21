<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests\Metadata;

use Rey\Orm\Metadata\MetadataContainer;

class MetadataContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Rey\Orm\Exception\UnexpectedTypeException
     */
    public function testCreateMetadataContainerExceptionForFirstParam()
    {
        $testMetadataContainer = new MetadataContainer(false, 'type', array());
    }

    /**
     * @expectedException \Rey\Orm\Exception\UnexpectedTypeException
     */
    public function testCreateMetadataContainerExceptionForSecondParam()
    {
        $testMetadataContainer = new MetadataContainer('name', false, array());
    }

    /**
     * @expectedException \Rey\Orm\Exception\UnexpectedTypeException
     */
    public function testCreateMetadataContainerExceptionForThirdParam()
    {
        $testMetadataContainer = new MetadataContainer('name', 'string', false);
    }

    public function testGetName()
    {
        $testName = 'someName';

        $testMetadataContainer = new MetadataContainer($testName, 'someType', array());

        $this->assertEquals($testMetadataContainer->getName(), $testName);
    }

    public function testGetType()
    {
        $testType = 'someType';

        $testMetadataContainer = new MetadataContainer('testEnity', $testType, array());

        $this->assertEquals($testMetadataContainer->getType(), $testType);
    }

    /**
     * @dataProvider someValue
     */
    public function testGetAndSetValue($params, $paramName)
    {
        $testMetadataContainer = new MetadataContainer('someName', 'someType', $params);

        $this->assertTrue($testMetadataContainer->get($paramName) === $params[$paramName]);
    }

    public function someValue()
    {
        $someValue = array(
                'id' => 123,
                'name' => 'testName',
                'params' => array('value'),
                'active' => true,
            );

        return array(
                array($someValue, 'id'),
                array($someValue, 'name'),
                array($someValue, 'params'),
                array($someValue, 'active'),
                array(array('active' => false), 'active'),
            );
    }

    public function testGetNonExistentValue()
    {
        $testMetadataContainer = new MetadataContainer('someName', 'someType', array('name' => 'testName'));

        $this->assertTrue($testMetadataContainer->get('nonexistentParams') === null);
    }
}