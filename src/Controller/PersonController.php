<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 21:06
 */

namespace Controller;

use Data\Entity\Person;
use Data\Repository\PersonRepository;
use Pimple\Container;
use Validator\PersonValidator;

class PersonController extends ControllerBase
{
    /**
     * @var PersonRepository
     */
    protected $_repo;

    public function __construct(Container $app)
    {
        parent::__construct($app);
        $this->setValidatorBase(PersonValidator::class);
        $this->setRepository(Person::class);
    }

    public function index()
    {
        return $this->render('person/index', ['persons' => $this->_repo->findAll(), 'person' => new Person()]);
    }

    public function search()
    {
        return $this->render('person/index', ['persons' => $this->_repo->search($this->getQueryParam('filter')),
            'filter' => $this->getQueryParam('filter') ]);
    }

    public function insert()
    {
        $errors = $this->validateRequest();

        if(count($errors) > 0) {
            return $this->render('person/index',$errors);
        }

        $post = $this->getPostParams();
        $id = $this->getPostParam('id');


        if($id == null) {
            $person = new Person();
        } else {

            $person = $this->_repo->find($id);
        }

        $test = $this->_repo->findOneBy(['name' => $post['name']]);

        if($test != null)
        {
            if($test->getId() != $id)
            {
                return $this->render('person/index',['error_name' => 'duplicate name. Try other name !',
                    'persons' => $this->_repo->findAll(), 'person' => $person]);
            }
        }

        $person->setName($post['name']);
        $person->setBirthDate(\DateTime::createFromFormat('Y-m-d',$post['birthDate']));

        if($id == null) {
            $this->persist($person);
        }
        else  {
            $this->merge($person);
        }

        $this->addSuccessNotification('it Works !');
        return $this->redirectToRoute('person_index');
    }

    public function delete($id)
    {
        $personId = $id; // $this->getQueryParam('personId');
        $test = $this->_repo->find($personId);
        if($test == null)
        {
            return $this->redirectToRoute('person_index');
        }

        if($test->getSales()->count() > 0)
        {
            $this->addDangerNotification('Person not deleted. This person has sales !.');
            return $this->redirectToRoute('person_index');
        }

        $this->remove($test);
        $this->addSuccessNotification('it Works !');

        return $this->redirectToRoute('person_index');
    }

    public function edit($id)
    {
        $personId = $id;
        $test = $this->_repo->find($personId);

        if($test == null)
        {
            return $this->redirectToRoute('person_index');
        }

        return $this->render('person/index', ['persons' => $this->_repo->findAll(), 'person' => $test]);
    }
}