<?php

namespace App\Business\Exceptions;

use Symfony\Component\Validator\ConstraintViolationList;

class BusinessException extends \Exception
{
    /**
     * @var ConstraintViolationList
     */
    public $errors;

    public function __construct($errors)
    {
        parent::__construct('', 0);

        $this->errors = $errors;
    }
}