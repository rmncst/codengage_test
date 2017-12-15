<?php

namespace Tests;

use Application\Provider\DoctrineOrmProvider;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;


/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 00:07
 */
class TestBase extends TestCase
{
    /**
     * @var EntityManager
     */
    protected $_em;


    protected function setUp()
    {
        $this->_em = DoctrineOrmProvider::bootstrapCliConnection();
    }


}