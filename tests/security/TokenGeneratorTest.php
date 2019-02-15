<?php
/**
 * Created by PhpStorm.
 * User: ravgus
 * Date: 15.02.19
 * Time: 11:55
 */

namespace App\Tests\security;

use App\Security\TokenGenerator;
use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase
{
    public function testGetRandomSecureToken()
    {
        $token = new TokenGenerator();
        $token = $token->getRandomSecureToken(30);

        $this->assertEquals(30, strlen($token));

        $this->assertEquals(1, preg_match('/[A-Za-z0-9]{30}/', $token));
        $this->assertTrue(ctype_alnum($token), 'Token includes incorrect characters'); //same as the previous

    }
}