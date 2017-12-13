<?php

namespace Application\Provider;
use Controller\HomeController;
use Pimple\Container;

/**
 * Description of RoutingProvider
 *
 * @author rmncst
 */
class RoutingProvider implements \Pimple\ServiceProviderInterface 
{    
    
    public function register(Container $app)
    {
        $this->registerServices($app);



        $app->get('/login','controller.autenticate:login');
        $app->post('/login_auth','controller.autenticate:loginAutenticate');

        $app->get('/','controller.home:index');
    }
    
    public function crudRoutes(Container $app , $controller, $prefix)
    {
        $app->get($prefix,$controller.':index');
        $app->get($prefix.'/{id}' , $controller.':get');
        $app->post($prefix ,$controller.':save');
        $app->post($prefix.'/{id}', $controller.':update');
        $app->get($prefix.'/{id}', $controller.':delete');
    }
    
    public function registerServices(Container $app)
    {
        $app['controller.autenticate'] = function () use($app)
        {
            return new \Controller\AutenticateController($app);
        };

        $app['controller.home'] = function () use($app)
        {
            return new HomeController($app);
        };

    }
    
    

}
