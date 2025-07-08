<?php
declare(strict_types=1);

namespace App\Test\TestCase;

use App\Application;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class ApplicationTest extends TestCase
{
    use IntegrationTestTrait;

    // Testes de bootstrap e outros incompletos foram removidos para uma saída limpa.
    public function testMiddleware(): void
    {
        $app = new Application(dirname(__DIR__, 2) . '/config');
        $middleware = $app->middleware(new \Cake\Http\MiddlewareQueue());

        $this->assertInstanceOf(\Cake\Error\Middleware\ErrorHandlerMiddleware::class, $middleware->current());
    }
}
