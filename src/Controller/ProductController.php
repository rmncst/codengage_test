<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 23:31
 */

namespace Controller;


use Data\Entity\Product;
use Data\Repository\ProductRepository;
use Pimple\Container;
use Validator\ProductValidator;

class ProductController extends ControllerBase
{
    /**
     * @var ProductRepository
     */
    protected $_repo;

    public function __construct(Container $app)
    {
        parent::__construct($app);
        $this->setValidatorBase(ProductValidator::class);
        $this->setRepository(Product::class);
    }

    public function index()
    {
        return $this->render('product/index', ['products' => $this->_repo->findAll()]);
    }

    public function insert()
    {
        $errors = $this->validateRequest();

        if(count($errors) > 0) {
            $errors = array_merge($errors,['products' => $this->_repo->findAll()]);
            return $this->render('product/index',$errors);
        }

        $post = $this->getPostParams();
        $id = $this->getQueryParam('id');

        if($id == null) {
            $product = new Product();
        } else {
            $product = $this->_repo->find($id);
        }

        $test = $this->_repo->findOneBy(['name' => $post['name']]);
        if($test != null)
        {
            if($test->getId() != $id)
            {
                return $this->render('product/index',['error_name' => 'duplicate name. Try other name !',
                    'products' => $this->_repo->findAll(), 'product' => $product]);
            }
        }

        $test = $this->_repo->findOneBy(['code' => $post['code']]);
        if($test != null)
        {
            if($test->getId() != $id)
            {
                return $this->render('product/index',['error_code' => 'duplicate code. Try other code !',
                    'products' => $this->_repo->findAll(), 'product' => $product]);
            }
        }

        $product->setName($post['name']);
        $product->setUnitPrice($post['unitPrice']);
        $product->setCode($post['code']);

        if($id == null) {
            $this->persist($product);
        }
        else  {
            $this->merge($product);
        }

        return $this->redirectToRoute('product_index');
    }

    public function delete($id)
    {
        $productId = $id; // $this->getQueryParam('personId');
        $test = $this->_repo->find($productId);
        if($test == null)
        {
            return $this->redirectToRoute('product_index');
        }

        $this->remove($test);
        return $this->redirectToRoute('product_index');
    }

    public function edit($id)
    {
        $productId = $id; // $this->getQueryParam('personId');
        $test = $this->_repo->find($productId);

        if($test == null)
        {
            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/index', ['products' => $this->_repo->findAll(), 'product' => $test]);
    }
}