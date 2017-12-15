<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 12/07/17
 * Time: 14:15
 */

namespace Application\Provider;


use Application\Common\ConfigApplication;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;


class ApplicationProvider extends ProviderBase implements ServiceProviderInterface
{

    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $app->register(new DoctrineOrmProvider());
        $app->register(new ServiceControllerServiceProvider());
        $app->register(new RoutingProvider());
        $app->register(new ControllerServiceProvider());
        $app->register(new TwigServiceProvider(), ['twig.path' => ConfigApplication::getPathView()]);
        $app->register(new AssetServiceProvider());
        $app->register(new ResponseProvider());
        $app->register(new SessionServiceProvider());
    }
}