<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Metadata;

use Rey\Orm\EntityManagerInterface;
use Rey\Orm\Metadata\MetadataContainer;
use Rey\Orm\Exception\RuntimeException;
use Rey\Orm\Exception\EntityNotFoundException;
use Rey\Orm\Tools\Cache;
use Rey\Orm\Tools\Dumper\ArrayDumper;
use Rey\Orm\Configuration;
use CIBlock, CModule;

/**
 * Bitrix Metadata factory
 *
 * @author Oleg Filimoshin <Olegator8800@yandex.ru>
 */
class BitrixMetadataFactory implements MetadataFactoryInterface
{
    /**
     * EntityManager
     * @var EntityManagerInterface
     */
    protected $entityManager = null;

    /**
     * Array of metadata for all registered entities
     * @var array
     */
    protected $entityMetadata = null;

    /**
     * {@inheritdoc}
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        if ($this->entityManager !== null) {
            throw new RuntimeException('EntityManager was already set');
        }

        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityMetadata($entityName)
    {
        $this->initialize();

        if (!isset($this->entityMetadata[$entityName])) {
            throw new EntityNotFoundException($entityName);
        }

        return $this->entityMetadata[$entityName];
    }

    /**
     * Get EntityManager configuration
     *
     * @return Configuration EntityManager configuration
     */
    protected function getConfig()
    {
        return $this->entityManager->getConfiguration();
    }

    /**
     * Get cache directory path for BitrixMetadataFactory
     *
     * @return string Cache directory path
     */
    protected function getCacheDir()
    {
        $siteID = $this->getConfig()->getSiteID();
        $siteID = empty($siteID) ? array('all') : $siteID;

        sort($siteID);
        $path = $this->getConfig()->getCacheDir() . '/' . implode($siteID, '_') . '/';

        if (!file_exists($path)) {
            mkdir($path, 0776, true);
        }

        return $path;
    }

    /**
     * Initialize metadata for all registered entities
     *
     * @return self
     */
    protected function initialize()
    {
        if ($this->entityMetadata === null) {
            $cache = new Cache($this->getCacheDir() . 'IblockMetadata.php', $this->getConfig()->isDebug());

            if (!$cache->isFresh()) {
                $iblockList = $this->getIblockList();
                $dumper = new ArrayDumper($iblockList);
                $content = $dumper->dump(array('array_name' => 'iblockList'));
                $cache->write($content);
            } else {
                require $cache;
            }

            foreach ($iblockList as $name => $data) {
                $this->entityMetadata[$name] = new MetadataContainer($name, 'iblockelement', array('IblockId' => $data['iblock_id']));
            }
        }

        return $this;
    }

    /**
     * Get infoblock list
     *
     * @return array Infoblock list
     *
     * @throws RuntimeException If Bitrix module not included
     */
    protected function getIblockList()
    {
        if (!CModule::IncludeModule('iblock')) {
            throw new RuntimeException(sprintf('Bitrix module "%s" not included', 'iblock'));
        }

        $iblockList = array();

        $r = CIBlock::GetList(array(), array('SITE_ID' => $this->getConfig()->getSiteID()));

        while ($iblock = $r->Fetch()) {
            $iblockList[$iblock['IBLOCK_TYPE_ID']] = array('iblock_id' => $iblock['ID']);
        }

        return $iblockList;
    }
}