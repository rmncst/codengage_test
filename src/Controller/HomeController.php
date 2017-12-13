<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 12/07/17
 * Time: 15:00
 */

namespace Controller;


use Pimple\Container;

class HomeController extends ControllerBase
{
    public function __construct(Container $app)
    {
        parent::__construct($app);
    }

    public function index()
    {
        return $this->render('home/index.twig',['message' => 'home page']);
    }
}