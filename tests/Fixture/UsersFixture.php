<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class UsersFixture extends TestFixture
{
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'email' => 'teste@exemplo.com',
                'password' => 'senha123',
                'role' => 'user',
                'created' => '2025-07-01 10:00:00',
                'modified' => '2025-07-01 10:00:00',
            ],
        ];
        parent::init();
    }
}
