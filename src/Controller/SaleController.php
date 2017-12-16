<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 14/12/17
 * Time: 00:02
 */

namespace Controller;


use Data\Entity\Person;
use Data\Entity\Product;
use Data\Entity\Sale;
use Data\Entity\SaleItem;
use Data\Repository\PersonRepository;
use Data\Repository\ProductRepository;
use Data\Repository\SaleRepository;
use Pimple\Container;
use Validator\SaleValidator;

class SaleController extends ControllerBase
{
    /**
     * @var SaleRepository
     */
    protected $_repo;

    /**
     * @var PersonRepository
     */
    protected $_repoPerson;

    /**
     * @var ProductRepository
     */
    protected $_repoProduct;

    public function __construct(Container $app)
    {
        parent::__construct($app);
        $this->setRepository(Sale::class);
        $this->setValidatorBase(SaleValidator::class);

        $this->_repoPerson = $this->_em->getRepository(Person::class);
        $this->_repoProduct = $this->_em->getRepository(Product::class);
    }

    public function index()
    {
        return $this->render('sale/index',$this->getParamsSale());
    }

    public function listSales()
    {
        return $this->render('sale/list',['sales' => $this->_repo->findBy([],['number' => 'ASC'])]);
    }
    public function listSalesSearch()
    {
        return $this->render('sale/list',['sales' => $this->_repo->search($this->getQueryParam('filter'))]);
    }

    public function insert()
    {
        $errors = $this->validateRequest();

        if(count($errors) > 0)
        {
            return $this->render('sale/index',array_merge($this->getParamsSale(),$errors));
        }
        $post = $this->getPostParams();

        $client = $this->_repoPerson->find($post['client']);
        $sale = new Sale();
        $sale->setClient($client);
        $sale->setDate(new \DateTime());
        $sale->setNumber($this->_repo->getNextNumberSequence());

        $index = 0;
        $total = 0;

        foreach ($post['products'] as $productId)
        {
            $product = $this->_repoProduct->find($productId);
            $saleItem = new SaleItem();
            $saleItem->setProduct($product);
            $saleItem->setSale($sale);
            $saleItem->setUnitPrice($product->getUnitPrice());
            $saleItem->setCount($post['counts'][$index]);
            $saleItem->setPercentDiscount($post['discounts'][$index] / 100);
            $this->persist($saleItem,false);

            $total += $saleItem->getTotal();
            $index++;
        }

        $sale->setTotal($total);
        $this->persist($sale);


        $this->addSuccessNotification('it Works !');
        return $this->redirectToRoute('sale_index');
    }

    public function delete($id)
    {
        $sale = $this->_repo->find($id);

        if($sale == null)
        {
            return $this->redirectToRoute('sale_list');
        }

        foreach ($sale->getItems() as $item)
        {
            $this->remove($item, false);
        }


        $this->addSuccessNotification('it Works !');
        $this->remove($sale);
        return $this->redirectToRoute('sale_list');
    }

    public function getParamsSale()
    {
        $return['persons'] = $this->_repoPerson->findAll();
        $return['products'] = $this->_repoProduct->findAll();

        return $return;
    }

    public function getItemSale()
    {
        $return['products'] = $this->_repoProduct->findAll();
        $return['hash'] = uniqid();

        return $this->render('sale/item-sale',$return);
    }

}