<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class ImageValidator extends AbstractValidator
{

    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/png');
        $mime = mime_content_type($this->value);
        if(in_array($mime, $allowed_mime_type_arr)){
            return true;
        }else{
            return false;
        }
    }


}
