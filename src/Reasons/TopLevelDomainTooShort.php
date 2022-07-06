<?php

namespace ShooglyPeg\EmailValidator\Reasons;

use Egulias\EmailValidator\Result\Reason\Reason;

final class TopLevelDomainTooShort implements Reason
{
    public function code(): int
    {
        return 999;
    }

    public function description(): string
    {
        return 'Top Level Domain Too Short';
    }
}
