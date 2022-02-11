<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class FloatValidator extends AbstractValidator
{

    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        if (!empty($this->value)) {
            return preg_match( '/^[0-9]*[.,][0-9]+$/', $this->value);
        }
        return true;
    }
}