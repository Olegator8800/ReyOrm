<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Metadata;

use Rey\Orm\Exception\UnexpectedTypeException;

/**
 * Metadata container
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class MetadataContainer implements MetadataContainerInterface
{

    /**
     * Entity name
     * @var string
     */
    protected $name;

    /**
     * Entity type
     * @var string
     */
    protected $type;

    /**
     * Container data
     * @var array
     */
    protected $data;

    /**
     * Create metadata container
     *
     * @param string $name Entity name
     * @param string $type Entity type
     * @param array  $data Data
     *
     * @throws UnexpectedTypeException if an argument is not of the expected type
     */
    public function __construct($name, $type, $data = array())
    {
        if (!is_string($name)) {
            throw new UnexpectedTypeException($name, 'string');
        }

        if (!is_string($type)) {
            throw new UnexpectedTypeException($type, 'string');
        }

        if (!is_array($data)) {
            throw new UnexpectedTypeException($data, 'array');
        }

        $this->name = $name;
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function get($param)
    {
        return isset($this->data[$param])
            ?   $this->data[$param]
            :   null;
    }
}