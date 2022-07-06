<?php

namespace ShooglyPeg\EmailValidator\Tests\Reasons;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\EmailValidator\Reasons\HasNoTopLevelDomain;
use ShooglyPeg\EmailValidator\Reasons\TopLevelDomainHasInvalidCharacters;
use ShooglyPeg\EmailValidator\Reasons\TopLevelDomainIsTooShort;

final class ReasonsTest extends TestCase
{
    /**
     * @dataProvider reasonsProvider
     */
    public function testInstantiates(string $className): void
    {
        $reason = new $className();

        $this->assertEquals(999, $reason->code());
        $this->assertEquals($this->getDescriptionFromClassName($className), $reason->description());
    }

    public function reasonsProvider(): array
    {
        return [
            [HasNoTopLevelDomain::class],
            [TopLevelDomainHasInvalidCharacters::class],
            [TopLevelDomainIsTooShort::class],
        ];
    }

    private function getDescriptionFromClassName(string $fqcn): string
    {
        $description = explode('\\', $fqcn)[3];
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $description, $matches);

        return implode(' ', $matches[0]);
    }
}
