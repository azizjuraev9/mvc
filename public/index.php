<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 07.10.2020
 * Time: 13:24
 */

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

require dirname(__DIR__) . '/config/doctrine.php';

\core\BaseModel::setEntityManager($entityManager);

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$config = require dirname(__DIR__) . '/config/config.php';

$application = new \core\Application($config);
$application->run();