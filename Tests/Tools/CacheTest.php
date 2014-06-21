<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests\Tools;

use Rey\Orm\Tools\Cache;

class CacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Path to the temporary cache directory
     * @var string
     */
    protected $testCachePath;
    /**
     * Path to the temporary cache file
     * @var string
     */
    protected $testCacheFile;

    protected function setUp()
    {
        $this->testCachePath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . time() . rand(0, 1000);
        $this->testCacheFile = $this->testCachePath . '/cache.tmp';
    }

    protected function tearDown()
    {
        if (file_exists($this->testCacheFile)) {
            chmod($this->testCacheFile, 0777);
            unlink($this->testCacheFile);
        }

        if (file_exists($this->testCachePath)) {
            chmod($this->testCachePath, 0777);
            rmdir($this->testCachePath);
        }
    }

    public function testToStringMethod()
    {
        $testPath = __DIR__ . '/cache/folder/';

        $cache = new Cache($testPath, false);
        $this->assertEquals($testPath, $cache->__toString());
    }

    public function testIsNotFresh()
    {
        $this->assertFalse(file_exists($this->testCacheFile));

        $cache = new Cache($this->testCacheFile, false);

        $this->assertFalse($cache->isFresh());
    }

    public function testIsFresh()
    {
        mkdir($this->testCachePath, 0777, true);
        file_put_contents($this->testCacheFile, '');
        $this->assertTrue(file_exists($this->testCacheFile));

        $cache = new Cache($this->testCacheFile, false);

        $this->assertTrue($cache->isFresh());
    }

    public function testIsFreshInDebug()
    {
        mkdir($this->testCachePath, 0777, true);
        file_put_contents($this->testCacheFile, '');
        $this->assertTrue(file_exists($this->testCacheFile));

        $cache = new Cache($this->testCacheFile, true);

        $this->assertFalse($cache->isFresh());
    }

    public function testWriteCache()
    {
        $testContent = '<?php echo("hellow test");';

        mkdir($this->testCachePath, 0777, true);

        $cache = new Cache($this->testCacheFile, true);
        $cache->write($testContent);

        $this->assertEquals(file_get_contents($cache), $testContent);
    }

    /**
     * @expectedException \Rey\Orm\Exception\RuntimeException
     */
    public function testWriteCacheException()
    {
        mkdir($this->testCachePath, 0000, true);

        $cache = new Cache($this->testCacheFile, true);

        $cache->write('test');
    }
}