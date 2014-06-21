<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Exception;

/**
 * Throw if entity not found
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class EntityNotFoundException extends LogicException
{
    /**
     * Throw an exception
     *
     * @param string $entityName Name of the entity
     */
    public function __construct($entityName)
    {
        parent::__construct(sprintf('Passed entity "%s" not found', $entityName));
    }
}