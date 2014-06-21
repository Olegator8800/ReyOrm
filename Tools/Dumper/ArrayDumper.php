<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tools\Dumper;

use Rey\Orm\Exception\InvalidArgumentException;

/**
 * Class for dump array as a php code
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class ArrayDumper implements DumperInterface
{
    /**
     * Data array
     * @var array
     */
    protected $arrayData = array();

    /**
     * Constructor
     *
     * @param array $arrayData Array to dump
     */
    public function __construct(array $arrayData = array())
    {
        $this->arrayData = $arrayData;
    }

    /**
     * Dump array
     *
     * If don't passed option "array_name" result will
     * <code>
     *     <?php return array(...
     * </code>
     * otherwise
     * <code>
     *     <?php ${array_name} =  array(...
     * </code>
     *
     * @param array $options Array of parameters for dumper
     *
     * @return string Contains an array php
     */
    public function dump(array $options = array())
    {
        if (!isset($options['array_name'])) {
            $code = sprintf('<?php return %s;', var_export($this->arrayData, true));
        } else {
            $code = sprintf('<?php $%s = %s;', $options['array_name'], var_export($this->arrayData, true));
        }

        return $code;
    }
}