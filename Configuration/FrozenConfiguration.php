<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Configuration;

/**
 * Abstract class allows to freeze value in configuration
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
abstract class FrozenConfiguration implements ConfigurationInterface
{
    /**
     * If configuration is frozen
     * @var boolean
     */
    protected $frozen = false;

    /**
     * {@inheritdoc}
     */
    public function freeze()
    {
        $this->frozen = true;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isFrozen()
    {
        return $this->frozen;
    }
}