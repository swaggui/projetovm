<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\TestSuite\TestCase;

class UsersTableTest extends TestCase
{
    protected array $fixtures = ['app.Users'];
    protected $Users;

    public function setUp(): void
    {
        parent::setUp();
        $this->Users = $this->getTableLocator()->get('Users');
    }

    public function tearDown(): void
    {
        unset($this->Users);
        parent::tearDown();
    }

    public function testValidationEmailIsRequired(): void
    {
        $user = $this->Users->newEntity(['password' => '123456']);
        $this->assertFalse($this->Users->save($user));
        $this->assertArrayHasKey('email', $user->getErrors());
    }

    public function testValidationEmailMustBeValid(): void
    {
        $user = $this->Users->newEntity(['email' => 'email-invalido', 'password' => '123456']);
        $this->assertFalse($this->Users->save($user));
        $this->assertArrayHasKey('email', $user->getErrors());
    }

    public function testValidationEmailMustBeUnique(): void
    {
        $user = $this->Users->newEntity(['email' => 'teste@exemplo.com', 'password' => '123456']);
        $this->assertFalse($this->Users->save($user));
        $this->assertArrayHasKey('email', $user->getErrors());
    }

    public function testValidationPasswordIsRequired(): void
    {
        $user = $this->Users->newEntity(['email' => 'novo.usuario@exemplo.com']);
        $this->assertFalse($this->Users->save($user));
        $this->assertArrayHasKey('password', $user->getErrors());
    }

    // NOVO TESTE
    public function testValidationPasswordIsNotEmpty(): void
    {
        $user = $this->Users->newEntity(['email' => 'outro@exemplo.com', 'password' => '']);
        $this->assertFalse($this->Users->save($user));
        $this->assertArrayHasKey('password', $user->getErrors());
    }

    public function testSaveSuccess(): void
    {
        $user = $this->Users->newEntity([
            'email' => 'usuario.valido@exemplo.com',
            'password' => '123456',
            'role' => 'user',
        ]);
        $this->assertInstanceOf('App\Model\Entity\User', $this->Users->save($user));
    }
}
