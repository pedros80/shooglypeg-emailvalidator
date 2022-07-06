<?php

namespace ShooglyPeg\EmailValidator\Reasons;

use Egulias\EmailValidator\Result\Reason\Reason;

class TopLevelDomainHasInvalidCharacters implements Reason
{
    public function code(): int
    {
        return 999;
    }

    public function description(): string
    {
        return 'Top Level Domain Has Invalid Characters';
    }
}
