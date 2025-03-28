<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TarefaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TarefaTable Test Case
 */
class TarefaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TarefaTable
     */
    protected $Tarefa;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Tarefa',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tarefa') ? [] : ['className' => TarefaTable::class];
        $this->Tarefa = $this->getTableLocator()->get('Tarefa', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tarefa);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TarefaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
