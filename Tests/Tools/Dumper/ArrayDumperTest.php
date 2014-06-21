<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests\Tools\Dumper;

use Rey\Orm\Tools\Dumper\ArrayDumper;

class ArrayDumperTest extends \PHPUnit_Framework_TestCase
{
    protected static $fixturesPath = "";

    public static function setUpBeforeClass()
    {
        self::$fixturesPath = realpath(__DIR__ . '/../../Fixtures/Tools/Dumper/');
    }

    public function testDumpNamedArray()
    {
        $testArray = array('elem1', 'elem2', 'node1' => array('elem1'));
        $arrayName = 'testArray';

        $arrayDumper = new ArrayDumper($testArray);

        $this->assertStringEqualsFile(self::$fixturesPath . '/Array/arrayNamedDump.php', $arrayDumper->dump(array('array_name' => $arrayName)));
    }

    public function testDumpUnNamedArray()
    {
        $testArray = array('elem1', 'elem2', 'node1' => array('elem1'), 'elem3');
        $arrayName = 'testArray';

        $arrayDumper = new ArrayDumper($testArray);

        $this->assertStringEqualsFile(self::$fixturesPath . '/Array/arrayUnNamedDump.php', $arrayDumper->dump());
    }
}