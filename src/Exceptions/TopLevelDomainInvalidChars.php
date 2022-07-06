<?php

namespace ShooglyPeg\EmailValidator\Exceptions;

use Egulias\EmailValidator\Result\Reason\Reason;

class TopLevelDomainInvalidChars implements Reason
{
    public function code(): int
    {
        return 999;
    }

    public function description(): string
    {
        return 'Invalid Characters In Top Level Domain';
    }
}
