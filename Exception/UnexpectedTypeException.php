<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Exception;

/**
 * UnexpectedTypeException called when passed type does not match
 *
 * Symfony Like
 *
 * @author  Fabien Potencier <fabien@symfony.com>
 */
class UnexpectedTypeException extends InvalidArgumentException
{
    public function __construct($value, $expectedType)
    {
        parent::__construct(sprintf('Expected argument must be "%s" type, "%s" given', $expectedType, is_object($value)?get_class($value):gettype($value)));
    }
}