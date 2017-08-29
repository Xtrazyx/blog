<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 24/08/2017
 * Time: 14:41
 */

namespace JHD\Framework;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

trait DoctrineEntityManager
{
    // Doctrine Entity Manager
    public function getEntityManager()
    {
        $config = new Config();
        $dbParams = $config->getConfigsByKey('doctrine')['dbParams'];
        $doctrineOrmConfig = $config->getConfigsByKey('doctrine')['ormConfig'];
        $ormConfig = Setup::createAnnotationMetadataConfiguration(
            $doctrineOrmConfig['entitiesPath'],
            $doctrineOrmConfig['isDevMode'],
            $doctrineOrmConfig['proxyDir'],
            $doctrineOrmConfig['cache'],
            $doctrineOrmConfig['useSimpleAnnotationReader']
        );

        return EntityManager::create($dbParams, $ormConfig);
    }
}