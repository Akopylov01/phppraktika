<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class LanguageValidator extends AbstractValidator
{

    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        if (!empty($this->value)) {
            return preg_match( '/[а-яёА-ЯЁ]+/u', $this->value);
        }
        return true;
    }
}