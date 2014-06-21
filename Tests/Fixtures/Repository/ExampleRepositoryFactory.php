<?php

/*
 * This file is part of the Rey ORM package.
 *
 * (c) Oleg Filimoshin <Olegator8800@yandex.ru>
 */

namespace Rey\Orm\Tests\Fixtures\Repository;

use Rey\Orm\Repository\RepositoryFactoryInterface;
use Rey\Orm\EntityManagerInterface;

class ExampleRepositoryFactory implements RepositoryFactoryInterface
{
	public function setEntityManager(EntityManagerInterface $entityManager)
	{

	}

	public function getRepository($entityName)
	{
		return 'RepositoryFor' . $entityName;
	}
}