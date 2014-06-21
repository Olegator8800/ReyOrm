<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Exception;

/**
 * If call frozen configuration method
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class FrozenConfigurationException extends LogicException
{
    /**
     * Throw an exception
     *
     * @param string $methodName Name of the called method
     */
    public function __construct($methodName)
    {
        $methodName = explode('::', $methodName);
        parent::__construct(sprintf('Impossible to call %s on a frozen configuration', end($methodName)));
    }
}