<?php

namespace Controller;
use Pimple\Container;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Validator\BaseValidator;

/**
 * Description of ControllerBase
 *
 * @author rmncst
 */
class ControllerBase 
{

    use Application\UrlGeneratorTrait;
    /**
     *
     * @var Application
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

    /**
     * @var Request
     */
    protected $_currentRequest;

    /**
     * @var BaseValidator
     */
    protected $_baseValidator;


    public function __construct(Container $app) {
        $this->_app = $app;
        $this->_em = $app['em'];
        $this->_currentRequest = $app['request_stack']->getCurrentRequest();
    }
    
    public function setRepository($repo)
    {
        $this->_repo = $this->_em->getRepository($repo);
    }

    public function setValidatorBase($class)
    {
        $type = new $class;
        if(!($type instanceof BaseValidator))
        {
            throw new \Exception('validator not extends class BaseValidator');
        }
        $this->_baseValidator = $type;
    }
    
    protected function render($view, $params = [])
    {
        $view = strpos($view,'.twig')  ? $view : $view.'.twig';
        return $this->_app['twig']->render($view, $params);
    }

    public function persist($entity, $flush = true)
    {
        $entity->setCreatedBy('defaultUser');
        $this->_em->persist($entity);
        if($flush === true){
            $this->_em->flush();
        }
    }

    public function merge($entity, $flush = true, $userAudit = null)
    {
        $entity->setUpdateBy('defaultUser');
        $this->_em->merge($entity);
        if($flush === true){
            $this->_em->flush();
        }
    }

    public function remove($entity, $flush = true)
    {
        $this->_em->remove($entity);
        if($flush === true){
            $this->_em->flush();
        }
    }

    public function getPostParams()
    {
        return $this->_currentRequest->request->all();
    }

    public function getPostParam($param)
    {
        return $this->_currentRequest->request->get($param);
    }

    public function getQueryParams()
    {
        return $this->_currentRequest->request->all();
    }

    public function getQueryParam($param)
    {
        return $this->_currentRequest->request->get($param);
    }

    public function abort($statusCode, $message)
    {
        $this->_app->abort($statusCode, $message);
    }

    public function validateRequest(array $ignoreFields = [])
    {
        return $this->validate($this->_baseValidator->assertConstraints($this->getPostParams(),$ignoreFields));
    }

    public function validate($errors)
    {
        $messages = [];

        if(count($errors) > 0)
        {
            foreach ($errors as $error)
            {
                $messages['error_'.str_replace(['[',']'],['',''],$error->getPropertyPath())] = $error->getMessage();
            }
        }

        return $messages;
    }

    public function redirectToRoute($route)
    {
        $url = $this->_app['url_generator']->generate($route, [], UrlGeneratorInterface::ABSOLUTE_URL);
        return $this->_app->redirect($url);
    }

}