<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;
    protected array $fixtures = ['app.Users'];

    // Teste "dummy" apenas para garantir que o arquivo não esteja vazio.
    public function testAlwaysTrue(): void
    {
        $this->assertTrue(true);
    }
}
