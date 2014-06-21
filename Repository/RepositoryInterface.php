<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Repository;

/**
 * Interface for all repositories
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
interface RepositoryInterface
{
    /**
     * Get entity type in the repository
     *
     * @return string Entity type in the repository
     */
    public function getType();

    /**
     * Get entity name in the repository
     *
     * @return string Entity name in the repository
     */
    public function getName();
}