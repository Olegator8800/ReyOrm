README
======

What is ReyOrm?
-----------------

The experimental version orm for Bitrix.


Installation
------------

via composer:

    $ php composer.phar require rey/orm dev-master


in your code add:

``` php
require_once __DIR__ . '/vendor/autoload.php';
```


Example
------------

Examples of work with ReyOrm (aflfa version):


Сode class repository for news:

``` php
use Rey\Orm\Repository\BaseRepository;
use CIBlockElement;

class NewsRepository extends BaseRepository
{
    public function getAllNews()
    {
        $r = CIBlockElement::getList(array(), array('IBLOCK_ID' => $this->getMetadata()->get('iblock_id')));

        return $r;
    }
}
```

User repository can structure business logic in classes.

``` php
$config = new Rey\Orm\Configuration();

$config->setCacheDir(__DIR__ . '/cache/orm');
$config->setRepositoryClass('News', 'NewsRepository');

$em = new Rey\Orm\EntityManager($config);

$newsRepository = $em->getRepository('News');
$newsList = $newsRepository->getAllNews();

while($newsItem = $newsList->Fetch()) {
    echo $newsItem['Title'] . '</ br>';
}
```

When calling $em->getRepository('News') will be searched for the information block code News.
If you have not set user repository for an News entity is returned instance Rey\Orm\Repository\BaseRepository.



Run tests
------------

You can run the unit tests with the following command:

    $ cd path/to/rey/orm/
    $ composer.phar install
    $ phpunit
