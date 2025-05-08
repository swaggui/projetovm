<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'email' => 'gradeurt@gmail.com',
                'password' => 'teste',
                'role' => 'Lorem ipsum dolor ',
                'created' => '2025-05-08 07:10:33',
                'modified' => '2025-05-08 07:10:33',
            ],
        ];
        parent::init();
    }
}
