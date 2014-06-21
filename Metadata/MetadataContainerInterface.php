<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Metadata;

/**
 * Interface for Metadata container
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
interface MetadataContainerInterface
{
    /**
     * Get entity name
     *
     * @return string Name for entity or repository
     */
    public function getName();

    /**
     * Get entity type
     *
     * @return string Type for entity or repository
     */
    public function getType();

    /**
     * Get value parameters
     *
     * @param  string $param Parameter name
     *
     * @return mixed        Parameter value
     */
    public function get($param);
}