<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{

    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        if ((strlen($this->value)>4) || ($this->value<1900 || $this->value>2022)){
            return false;
        }
        return true;
    }
}