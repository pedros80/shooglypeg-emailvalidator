<?php

namespace ShooglyPeg\EmailValidator\Reasons;

use Egulias\EmailValidator\Result\Reason\Reason;

final class HasNoTopLevelDomain implements Reason
{
    public function code(): int
    {
        return 999;
    }

    public function description(): string
    {
        return 'No Top Level Domain';
    }
}
