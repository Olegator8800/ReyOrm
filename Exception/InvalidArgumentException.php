<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Exception;

/**
 * Base ExceptionInterface for the ORM
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
}