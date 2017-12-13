<?php

namespace Controller;
use Pimple\Container;

/**
 * Description of ControllerBase
 *
 * @author rmncst
 */
class ControllerBase 
{
    /**
     *
     * @var \Pimple\Container
     */
    protected $_app;
    
    /**
     *
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $_repo;
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;


    public function __construct(Container $app) {
        $this->_app = $app;
        $this->_em = $app['em'];
    }
    
    public function setRepository($repo)
    {
        $this->_repo = $this->_em->getRepository($repo);
    }
    
    protected function render($view, $params)
    {
        return $this->_app['twig']->render($view, $params);
    }
}