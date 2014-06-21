<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm;

use Rey\Orm\Configuration\FrozenConfiguration;
use Rey\Orm\Configuration\ConfigurationInterface;
use Rey\Orm\Exception\InvalidConfigurationException;
use Rey\Orm\Exception\FrozenConfigurationException;
use Rey\Orm\Repository\RepositoryFactory;
use Rey\Orm\Repository\RepositoryFactoryInterface;
use Rey\Orm\Metadata\MetadataFactoryInterface;
use Rey\Orm\Metadata\BitrixMetadataFactory as MetadataFactory;

/**
 * Class for storing EntityManager configuration
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class Configuration extends FrozenConfiguration
{
    /**
     * Parameter storage
     * @var array
     */
    protected $parameters;

    /**
     * Sets the default values for parameters
     */
    public function __construct()
    {
        $this->parameters['debug'] = false;
        $this->parameters['cacheDir'] = null;
        $this->parameters['repository'] = array();
        $this->parameters['baseRepository'] = '\Rey\Orm\Repository\BaseRepository';
        $this->parameters['siteID'] = array();
    }

    /**
     * {@inheritdoc}
     */
    public function setDebug($debug)
    {
        if ($this->isFrozen()) {
            throw new FrozenConfigurationException(__METHOD__);
        }

        if (!is_bool($debug)) {
            throw new InvalidConfigurationException('$debug must be boolean type');
        }

        $this->parameters['debug'] = $debug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isDebug()
    {
        return $this->parameters['debug'];
    }

    /**
     * {@inheritdoc}
     */
    public function setRepositoryFactory(RepositoryFactoryInterface $factory)
    {
        if ($this->isFrozen()) {
            throw new FrozenConfigurationException(__METHOD__);
        }

        $this->parameters['repositoryFactory'] = $factory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRepositoryFactory()
    {
        return isset($this->parameters['repositoryFactory'])
            ?   $this->parameters['repositoryFactory']
            :   new RepositoryFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseRepositoryClass($class)
    {
        if ($this->isFrozen()) {
            throw new FrozenConfigurationException(__METHOD__);
        }

        if (!is_string($class)) {
            throw new InvalidConfigurationException('$class must be string type');
        }

        $this->parameters['baseRepository'] = $class;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseRepositoryClass()
    {
        return $this->parameters['baseRepository'];
    }

    /**
     * {@inheritdoc}
     */
    public function setRepositoryClass($entityName, $class)
    {
        if ($this->isFrozen()) {
            throw new FrozenConfigurationException(__METHOD__);
        }

        if (!is_string($entityName)) {
            throw new InvalidConfigurationException('$entityName must be string type');
        }

        if (!is_string($class)) {
            throw new InvalidConfigurationException('$class must be string type');
        }

        $this->parameters['repository'][$entityName] = $class;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRepositoryClass($entityName)
    {
        return isset($this->parameters['repository'][$entityName])
            ?   $this->parameters['repository'][$entityName]
            :   null;
    }

    /**
     * {@inheritdoc}
     */
    public function setCacheDir($path)
    {
        if ($this->isFrozen()) {
            throw new FrozenConfigurationException(__METHOD__);
        }

        if (!is_readable($path) || !is_writeable($path)) {
            throw new InvalidConfigurationException(sprintf('This path "%s" can not be read or written', $path));
        }

        $this->parameters['cacheDir'] = $path;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return $this->parameters['cacheDir'];
    }

    /**
     * {@inheritdoc}
     */
    public function setMetadataFactory(MetadataFactoryInterface $factory)
    {
        if ($this->isFrozen()) {
            throw new FrozenConfigurationException(__METHOD__);
        }

        $this->parameters['metadataFactory'] = $factory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadataFactory()
    {
        return isset($this->parameters['metadataFactory'])
            ?   $this->parameters['metadataFactory']
            :   new MetadataFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function setSiteID($siteID)
    {
        if ($this->isFrozen()) {
            throw new FrozenConfigurationException(__METHOD__);
        }

        if (!is_string($siteID) && !is_array($siteID)) {
            throw new InvalidConfigurationException('$siteID must be string or array type');
        }

        $this->parameters['siteID'] = empty($siteID) ? array() : (array) $siteID;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSiteID()
    {
        return $this->parameters['siteID'];
    }
}