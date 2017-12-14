<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 23:31
 */

namespace Validator;


use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Symfony\Component\Validator\Constraints\Type;

class ProductValidator extends BaseValidator
{

    public function getConstraints()
    {
        return new Collection(array(
            'id' => new Optional(),
            'name' => new NotBlank(),
            'unitPrice' => [new Type('numeric'),new GreaterThan(0)],
            'code' => new NotBlank()
        ));
    }
}