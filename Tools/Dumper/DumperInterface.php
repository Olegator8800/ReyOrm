<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tools\Dumper;

/**
 * Interface for classes dumper
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
interface DumperInterface
{
    /**
     * Dump structure
     *
     * @param array $options Array of parameters for dumper
     *
     * @return string Php code
     */
    public function dump(array $options = array());
}