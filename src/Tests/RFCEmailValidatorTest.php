<?php

declare(strict_types=1);

namespace ShooglyPeg\EmailValidator\Tests;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\EmailValidator\RFCEmailValidator;

final class RFCEmailValidatorTest extends TestCase
{
    private RFCEmailValidator $validator;

    public function setUp(): void
    {
        parent::setUp();
        $this->validator = new RFCEmailValidator();
    }

    /**
     * @dataProvider emailDataProvider
     */
    public function testEmailAddresses(string $email, bool $valid): void
    {
        $this->assertEquals($this->validator->validate($email), $valid);
    }

    public function emailDataProvider(): array
    {
        return [
            // Invalid Email Addresses
            ['plainaddress', false],
            ['#@%^%#$@#$@#.com', false],
            ['@example.com', false],
            ['Peter Somerville <email@example.com>', false],
            ['email.example.com', false],
            ['.email@example.com', false],
            ['email.@example.com', false],
            ['email..email@example.com', false],
            ['email@example.com (Joe Smith)', false],
            ['email@example', false],
            ['email@example..com', false],
            ['Abc..123@example.com', false],
            ['"(),:;<>[\]@example.com', false],
            ['just"not"right@example.com', false],
            ['this\ is\"really\"not\\\\allowed@example.com', false],
            ['peterwsomerville@example..com.', false],
            ['.peterwsomerville@example..com.', false],
            ['peter@somerville@example.com.', false],
            ['peter.somerville@exam\ple.com', false],
            ['peter.somerville@exam/ple.com', false],
            ['peter"@shooglypeg.co.uk', false],
            ['peter@example.x', false],
            ['example@example.123', false],
            ['mailto:example@example.com', false],

            // Valid Email Addresses
            ['email@example.com', true],
            ['firstname.lastname@example.com', true],
            ['email@subdomain.example.com', true],
            ['firstname+lastname@example.com', true],
            ['email@123.123.123.123', true],
            ['"email"@example.com', true],
            ['1234567890@example.com', true],
            ['email@example-one.com', true],
            ['_______@example.com', true],
            ['email@example.name', true],
            ['email@example.museum', true],
            ['email@example.co.jp', true],
            ['firstname-lastname@example.com', true],
            ['peter-somerville@example.com', true],
            ['peter@example.uk', true],
            ['much."more\unusual"@example.com', true],
            ['あいうえお@example.com', true],
            ['josé@abç.РФ', true],
            ['xn--jos@ab-1uam.xn--p1ai', true],
        ];
    }
}