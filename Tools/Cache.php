<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tools;

use Rey\Orm\Exception\RuntimeException;

/**
 * Сlass to manage cache
 * Analogue symfony ConfigCache
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class Cache
{
    /**
     * Cache file name
     * @var string
     */
    private $file;

    /**
     * Debugging mode
     * @var bool
     */
    private $debug;

    /**
     * Create cache instance
     *
     * @param string    $file  Cache file name (absolute path)
     * @param bool      $debug Debugging mode
     */
    public function __construct($file, $debug)
    {
        $this->file = $file;
        $this->debug = (bool) $debug;
    }

    /**
     * Check the relevance of the cache
     *
     * If debug mode enable, always returns false
     *
     * @return boolean True if cache is fresh, false otherwise
     */
    public function isFresh()
    {
        if (!is_file($this->file)) {
            return false;
        }

        if ($this->debug) {
            return false;
        }

        return true;
    }

    /**
     * Write data to cache
     *
     * @param  string $content The content to write in the cache
     *
     * @throws RuntimeException If cache file cannot be written
     */
    public function write($content)
    {
        if (@file_put_contents($this->file, $content) === false) {
            throw new RuntimeException(sprintf('Cache file "%s" cannot be written', $this->file));
        }
    }

    /**
     * Get path to cache file
     *
     * @return string Path to cache file
     */
    public function __toString()
    {
        return $this->file;
    }
}