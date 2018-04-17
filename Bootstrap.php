<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bootstrap
 *
 * @author NeonTetras
 */
require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

//use Cerad\Bundle\CoreBundle\Doctrine\DQL\Date;

class Bootstrap {

    private $entityManager;

    public function __construct() {
        $isDevMode = true;

        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/points"), $isDevMode, null, null, false);

        $config->addCustomDatetimeFunction('DATE', Date::class);
        
        /**
         * db connectivity
         */
        $conn = array("driver" => "pdo_mysql",
            "host" => "127.0.0.1",
            "dbname" => "chatonx",
            "user" => "root",
            "password" => "");

//obtaining the entity manager
        $this->entityManager = EntityManager::create($conn, $config);
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    }

}

$bootstrap = new Bootstrap();
$entityManager = $bootstrap->getEntityManager();
