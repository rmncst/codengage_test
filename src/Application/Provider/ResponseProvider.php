<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 20:43
 */

namespace Application\Provider;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResponseProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $this->registerCustomErrors($app);
    }

    public function registerCustomErrors(Application $app)
    {
        $app->error(function (\Exception $e, Request $request, $code) use($app) {
            switch ($code) {
                case 404:
                    $message = 'The requested page could not be found.';
                    break;
                default:
                    $message = 'We are sorry, but something went terribly wrong.';
            }
            $message = $e->getMessage();
            $response = $app['twig']->render('error/error500.twig',['message' => $message]);
            return new Response($response);
        });
    }
}