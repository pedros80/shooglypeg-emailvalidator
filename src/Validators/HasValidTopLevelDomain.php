<?php

namespace ShooglyPeg\EmailValidator\Validators;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Validation\EmailValidation;
use ShooglyPeg\EmailValidator\Exceptions\HasNoTopLevelDomain;
use ShooglyPeg\EmailValidator\Exceptions\TopLevelDomainInvalidChars;
use ShooglyPeg\EmailValidator\Exceptions\TopLevelDomainTooShort;

final class HasValidTopLevelDomain implements EmailValidation
{
    private ?InvalidEmail $error = null;

    public function isValid($email, EmailLexer $emailLexer): bool
    {
        $pieces = explode('@', $email);

        if (!isset($pieces[1]) || !strpos($pieces[1], '.')) {
            $this->error = new InvalidEmail(new HasNoTopLevelDomain(), '');
            return false;
        }

        $domain = $pieces[1];
        $parts  = explode('.', $domain);
        $tld    = $parts[count($parts) - 1];

        if (strlen($tld) < 2) {
            $this->error = new InvalidEmail(new TopLevelDomainTooShort(), '');
            return false;
        }

        if (!$this->alphabetical($tld) && !$this->isIntl($tld) && !$this->isIp($domain)) {
            $this->error = new InvalidEmail(new TopLevelDomainInvalidChars(), '');
            return false;
        }

        return true;
    }

    private function isIntl(string $tld): bool
    {
        return substr($tld, 0, 4) === 'xn--';
    }

    private function isIp(string $domain): bool
    {
        return (bool) filter_var($domain, FILTER_VALIDATE_IP);
    }

    private function alphabetical(string $tld): bool
    {
        return preg_replace("/[0-9 \(\)]/", "", $tld) === $tld;
    }

    public function getError(): ?InvalidEmail
    {
        return $this->error;
    }

    public function getWarnings(): array
    {
        return [];
    }
}
