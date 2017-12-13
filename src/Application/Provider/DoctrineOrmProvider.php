<?php
namespace Application\Provider;

use Application\Common\ConfigApplication;
use Data\Repository\CustomRepositoryBase;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Pimple\ServiceProviderInterface;
use Pimple\Container;

/**
 * Description of DoctrineOrmProvider
 *
 * @author Ramon Costa
 */
class DoctrineOrmProvider extends ProviderBase implements ServiceProviderInterface 
{
    const PREFIX_CONNECTIONS = 'parameters.connections';
    const PREFIX_ENTITY_MANAGER = 'em';
    const PREFIX_DEFAULT_CONNECTION = 'parameters.connection.default';

    private $connections = array();
    
    public function __construct() 
    {
        $this->connections = ConfigApplication::getParametersConnections();
    }

    public function register(Container $app) 
    {
        $this->registerConnections($app, $this->connections);
        
    }
    
    public function registerConnections(Container $app, array $connections)
    {
        $temp = [];
        foreach ($connections as $key => $value) 
        {
            $temp[] = $key;
            $app[self::PREFIX_CONNECTIONS.'.'.$key] = $value;
            
            if(array_key_exists('default',$value) && $value['default'] == 'true')
            {
                $value['name'] = $key;
                $app[self::PREFIX_DEFAULT_CONNECTION] = $value;
            }
            
            if(array_key_exists('ormmetadata',$value)) 
            {
                if(array_key_exists('default',$value))
                {
                    $this->registerEntityManager($app, $value, '');
                }
                        
                $this->registerEntityManager($app, $value, '.'.$key);
            }
        }
        
        $app[self::PREFIX_CONNECTIONS] = $temp;
    }
    
    public function registerEntityManager(Container $app, array $connection, $nameConnection)
    {
        $app[self::PREFIX_ENTITY_MANAGER.''.$nameConnection] = function() use($connection,$app){
            return self::bootstrapDoctrineEntityManager($connection, $app['debug']);
        };
    }
    
    public static function bootstrapDoctrineEntityManager(array $connection, $isDevMode)
    {
        
        $paths = array(realpath(ConfigApplication::getPathMetadataEntityAnnotation()));
        $reader = new AnnotationReader();
        $driver = new AnnotationDriver($reader, $paths);
        
        $config = Setup::createAnnotationMetadataConfiguration($paths , $isDevMode);
        $config->setMetadataDriverImpl($driver);
        $config->setEntityNamespaces([ConfigApplication::getEntityNamespace()]);
        $config->setDefaultRepositoryClassName(CustomRepositoryBase::class);
        $config->setProxyDir(ConfigApplication::getPathMetadataProxy());
        $config->setProxyNamespace(ConfigApplication::getProxyNamespace());
        
        $entityManager= EntityManager::create($connection, $config);
        
        $entityManager->getConnection()
                ->getDatabasePlatform()
                ->registerDoctrineTypeMapping('bit', 'boolean');
        
        return $entityManager;
    }
    
    public static function bootstrapCliConnection()
    {
        return self::bootstrapDoctrineEntityManager(ConfigApplication::getParametersCliConnection(), true);
    }
}
