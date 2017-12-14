<?php

namespace Application\Provider;

use Application\Common\ConfigApplication;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of RoutingProvider
 *
 * @author rmncst
 */
class RoutingProvider implements ServiceProviderInterface
{    
    
    public function register(Container $app)
    {
        $this->registerRoutesFromFile($app);
    }


    public function registerRoutesFromFile(Application $app)
    {
        $routes = ConfigApplication::getRoutesArray();

        foreach ($routes['routes'] as $key => $val)
        {
            $app->match($val['path_uri'],$val['action'])
                ->method($val['method'])
                ->bind($key);
        }

        foreach ($routes['routes_grouped'] as $key => $val)
        {
            $prefix = $val['prefix'];
            $name = $key;

            foreach ($val['routes'] as $subkey => $subval)
            {
                $method = $subval['method'];

                $app->match($prefix.''.$subval['path_uri'], $subval['action'])
                    ->method($method)
                    ->before(function (Request $request, Application $application){
                        // do something
                    })
                    ->bind($name.'_'.$subkey);
            }
        }
    }
    
    

}
