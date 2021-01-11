<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 12.10.2020
 * Time: 23:52
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = './tmp';
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(
    [ dirname(__DIR__) . '/models' ],
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = [
    'driver' => 'pdo_pgsql',
    'user'     => 'postgres',
    'password' => '',
    'dbname'   => 'mvc',
];

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);