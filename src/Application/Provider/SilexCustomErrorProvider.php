<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 12/07/17
 * Time: 14:21
 */

namespace Application\Provider;


use Application\Exception\SecurityException;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class SilexCustomErrorProvider implements ServiceProviderInterface
{

    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        $app->error(function (SecurityException $erro){
            return new Response('Você é um intruso, '. $erro->getMessage(),404);
        });

        $app->error(function(\Exception $erro){
            return new Response('Oops, erro: '. $erro->getMessage(),500);
        });
    }
}