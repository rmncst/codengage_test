<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 14/12/17
 * Time: 01:12
 */

namespace Validator;


use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class SaleValidator extends BaseValidator
{

    public function getConstraints()
    {
        return new Collection(array(
            'client' => new NotBlank(),
            'products' => new Type('array'),
            'counts' => new Type('array'),
            'discounts' => new Type('array'),
        ));
    }
}