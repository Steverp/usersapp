<?php

namespace config;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once '../vendor/autoload.php';

class DbConnection
{
    public function getDbConnection(): EntityManager|string
    {
        try{
            $connectionParams = array(
                'dbname' => 'usersapp',
                'user' => 'root',
                'password' => 'admin123',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            );

            $isDevMode = true;
            $proxyDir = null;
            $cache = null;
            $useSimpleAnnotationReader = false;
            $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Entity"), true, $proxyDir, $cache, false);

            return EntityManager::create($connectionParams, $config);
        }catch (\Throwable $connEx){
            return $connEx->getMessage();
        }
    }
}