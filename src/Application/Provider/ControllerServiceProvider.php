<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 19:37
 */

namespace Application\Provider;


use Application\Common\ConfigApplication;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ControllerServiceProvider implements ServiceProviderInterface
{

    public function register(Container $app)
    {
        foreach ($this->getControllersDirectoryPath() as $controller)
        {
            $controllerName = $this->normalizeNameController($controller);

            if($controllerName != "")
            {
                $controller = 'Controller\\'.str_replace('.php','',$controller);
                $app['controller.'.$controllerName] = function () use($app,$controller){
                    return new $controller($app);
                };
            }
        }

        foreach ($this->getDirectoriesInControllerPath() as $dir)
        {
            foreach ($this->getControllersDirectoryPath($dir) as $controller)
            {
                $controllerName = $this->normalizeNameController($controller);

                if($controllerName != "")
                {
                    $controller = 'Controller\\'.$dir.'\\'.str_replace('.php','',$controller);
                    $app['controller.'.strtolower($dir).'.'.$controllerName] = function () use($app,$controller){
                        return new $controller($app);
                    };
                }
            }
        }

    }

    public function getControllersDirectoryPath($dir = "")
    {
        $data = scandir(ConfigApplication::getControllerRootDirectory()."/".$dir);
        return $data;
    }

    public function getDirectoriesInControllerPath()
    {
        $data = $this->getControllersDirectoryPath();
        return  array_filter($data,function($val, $key){
            return  is_dir(ConfigApplication::getControllerRootDirectory().'/'.$val);
        },ARRAY_FILTER_USE_BOTH);
    }

    public static function getDirectoriesInControllerPathStatic()
    {
        $data =  scandir(ConfigApplication::getControllerRootDirectory());
        return  array_filter($data,function($val, $key){
            return  is_dir(ConfigApplication::getControllerRootDirectory().'/'.$val);
        },ARRAY_FILTER_USE_BOTH);
    }

    public function normalizeNameController($entry)
    {
        $newname = str_replace('.php','',strtolower($entry));
        $newname = str_replace('controller','',$newname);
        $newname = str_replace('.','',$newname);

        return $newname;
    }
}