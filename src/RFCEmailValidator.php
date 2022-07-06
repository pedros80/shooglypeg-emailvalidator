<?php

namespace ShooglyPeg\EmailValidator;

use ShooglyPeg\EmailValidator\Validators\HasValidTopLevelDomain;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;

final class RFCEmailValidator
{
    private EmailValidator $validator;
    private MultipleValidationWithAnd $validations;

    public function __construct()
    {
        $this->validator   = new EmailValidator();
        $this->validations = new MultipleValidationWithAnd([
            new RFCValidation(),
            new HasValidTopLevelDomain(),
        ]);
    }

    public function validate(string $email): bool
    {
        return $this->validator->isValid($email, $this->validations);
    }
}
