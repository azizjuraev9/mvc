<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 14.10.2020
 * Time: 13:56
 */
//require 'vendor/autoload.php';
require 'doctrine.php';

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;


$helperSet = new HelperSet();

$connection = $entityManager->getConnection();

$configuration = new Configuration( $connection );
$configuration->setName('MVC Migrations');
$configuration->setMigrationsNamespace('migrations');
$configuration->setMigrationsTableName('doctrine_migration_versions');
$configuration->setMigrationsColumnName('version');
$configuration->setMigrationsColumnLength(255);
$configuration->setMigrationsExecutedAtColumnName('executed_at');
$configuration->setMigrationsDirectory('../migrations');
$configuration->setAllOrNothing(true);
$configuration->setCheckDatabasePlatform(false);

$helperSet = new HelperSet();
$helperSet->set(new QuestionHelper(), 'question');
$helperSet->set(new ConnectionHelper($connection), 'db');
$helperSet->set(new ConfigurationHelper($connection, $configuration));
$helperSet->set(new EntityManagerHelper($entityManager));
//$helperSet->set(new File)


return $helperSet;
