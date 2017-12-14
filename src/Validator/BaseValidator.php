<?php

namespace Validator;
use Symfony\Component\Validator\Validation;

/**
 * Created by PhpStorm.
 * User: rmncst
 * Date: 13/12/17
 * Time: 20:18
 */
abstract class BaseValidator
{
    public abstract function getConstraints();

    public function assertConstraints(array $input, array $ignoreFields = [])
    {
        $validator = Validation::createValidator();
        $constraints = static::getConstraints();

        foreach ($ignoreFields as $value)
        {
            unset($constraints->fields[$value]);
        }

        $errors = $validator->validate($input,$constraints);
        return $errors;
    }
}