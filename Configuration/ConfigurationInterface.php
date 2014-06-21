<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Configuration;

use Rey\Orm\Repository\RepositoryFactoryInterface;
use Rey\Orm\Metadata\MetadataFactoryInterface;
use Rey\Orm\Exception\InvalidConfigurationException;
use Rey\Orm\Exception\FrozenConfigurationException;

/**
 * Interface for storing configuration
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
interface ConfigurationInterface
{
    /**
     * Freeze configuration in read-only mode
     *
     * @return self
     */
    public function freeze();

    /**
     * Check whether config is frozen
     *
     * @return boolean
     */
    public function isFrozen();

    /**
     * Set Debug mode
     *
     * @param bool $debug Enable debug mode
     *
     * @return  self
     *
     * @throws InvalidConfigurationException if an argument is not of the expected type
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function setDebug($debug);

    /**
     * Check debug mode
     *
     * @return boolean
     */
    public function isDebug();

    /**
     * Set base repository class
     *
     * @param string $class Repository class
     *
     * @return  self
     *
     * @throws InvalidConfigurationException if an argument is not of the expected type
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function setBaseRepositoryClass($class);

    /**
     * Get base repository class
     *
     * @return string Repository class
     *
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function getBaseRepositoryClass();

    /**
     * Set factory repository
     *
     * @param RepositoryFactoryInterface $factory Factory repository
     *
     * @return  self
     *
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function setRepositoryFactory(RepositoryFactoryInterface $factory);

    /**
     * Get factory repository
     *
     * @return RepositoryFactoryInterface Factory repository
     */
    public function getRepositoryFactory();


    /**
     * Set repository class for entity
     *
     * @param string $entityName Entity name
     * @param string $class  Class name
     *
     * @return  self
     *
     * @throws InvalidConfigurationException if an argument is not of the expected type
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function setRepositoryClass($entityName, $class);

    /**
     * Get repository class for entity
     *
     * @return null|string Class name repository
     */
    public function getRepositoryClass($entityName);

    /**
     * Set directory to cache
     *
     * @param string $path Path to directory
     *
     * @return  self
     *
     * @throws InvalidConfigurationException if a directory cannot be read or written
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function setCacheDir($path);

    /**
     * Get cache dirictory
     *
     * @return null|string Path
     */
    public function getCacheDir();

    /**
     * Set Metadata Factory
     *
     * @param MetadataFactoryInterface $factory MetadataFactory
     *
     * @return  self
     *
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function setMetadataFactory(MetadataFactoryInterface $factory);

    /**
     * Get Metadata Factory
     *
     * @return MetadataFactoryInterface MetadataFactory
     */
    public function getMetadataFactory();

    /**
     * Set site identificators
     * If passed empty array or empty string will return all sites
     *
     * @param string|array $siteID Site id
     *
     * @return self
     *
     * @throws InvalidConfigurationException if an argument is not of the expected type
     * @throws FrozenConfigurationException  If configuration is frozen
     */
    public function setSiteID($siteID);

    /**
     * Get site identificators
     *
     * @return array Site id
     */
    public function getSiteID();
}