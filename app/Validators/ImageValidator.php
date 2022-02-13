<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class ImageValidator extends AbstractValidator
{

    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        $allowed_mime_type_arr = array('image/jpg','image/jpeg','image/png');
        $fileType = $_FILES['image']['type'];
        return in_array($fileType, $allowed_mime_type_arr);
    }


}
