<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 12/07/17
 * Time: 15:00
 */

namespace Controller;


use Pimple\Container;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Validator\PersonValidator;

class HomeController extends ControllerBase
{
    public function __construct(Container $app)
    {
        parent::__construct($app);
        $this->setValidatorBase(PersonValidator::class);
    }

    public function index()
    {
        $errors = $this->validateRequest();


        return $this->render('master.twig',['message' => 'home page']);
    }
}