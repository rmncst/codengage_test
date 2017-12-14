<?php
/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 20:20
 */

namespace Validator;


use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;
use Webmozart\Assert\Assert;

class PersonValidator extends BaseValidator
{
    public function getConstraints()
    {
        return new Collection(array(
            'id' => new Optional(),
            'name' => new NotBlank(),
            'birthDate' => [new DateTime(['format' => 'Y-m-d']), new NotBlank()],
        ));
    }
}