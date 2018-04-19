<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Module\TransactionBuilder;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User
     * 
     * @var \App\Model\User
     */
    protected $user;

    /**
     * Account
     * 
     * @var \App\Model\Account
     */
    protected $account;

    /**
     * First payload
     * 
     * @var array
     */
    protected $payload = [];

    /**
     * Second payload
     * 
     * @var array
     */
    protected $payload2 = [];

    /**
     * Transaction Builder
     * 
     * @var \App\Http\Controllers\Module\TransactionBuilder
     */
    protected $builder;

    /**
     * Initialize data
     */
    private function initialize()
    {
        $this->user = factory(\App\Model\User::class)->create();
        $this->account = factory(\App\Model\Account::class)->create([
            'user_id' => $this->user->id
        ]);
        $this->payload = [
            'user_id' => $this->user->id,
            'amount' => rand(1000, 100000),
            'description' => str_random(100),
            'date' => date('Y-m-d')
        ];
        $this->payload2 = [
            'user_id' => $this->user->id,
            'amount' => rand(1000, 100000),
            'description' => str_random(100),
            'date' => date('Y-m-d')
        ];
        $this->builder = new TransactionBuilder($this->account);
    }

    /** @test */
    public function testNewlyCreated()
    {
        $this->initialize();

        $this->assertEquals($this->builder->getBalance(), 0);
    }

    /** @test */
    public function testAddCredit()
    {
        $this->initialize();

        $this->builder->addCredit($this->payload['amount']);
        $this->builder->setDescription($this->payload['description']);
        $this->builder->setDate($this->payload['date']);
        $this->builder->save();

        $this->assertFalse(is_null($this->builder->getLast()));
        $this->assertEquals($this->builder->getBalance(), $this->payload['amount']);
        $this->assertDatabaseHas('transactions', $this->payload);

        $this->builder->addCredit($this->payload2['amount']);
        $this->builder->setDescription($this->payload2['description']);
        $this->builder->setDate($this->payload2['date']);
        $this->builder->save();

        $this->assertEquals($this->builder->getBalance(), $this->payload['amount'] + $this->payload2['amount']);
        $this->assertDatabaseHas('transactions', $this->payload2);
    }

    /** @test */
    public function testAddDebit()
    {
        $this->initialize();

        $this->builder->addDebit($this->payload['amount']);
        $this->builder->setDescription($this->payload['description']);
        $this->builder->setDate($this->payload['date']);
        $this->builder->save();

        $this->assertEquals($this->builder->getBalance(), 0 - $this->payload['amount']);
        $this->assertDatabaseHas('transactions', $this->payload);

        $this->builder->addDebit($this->payload2['amount']);
        $this->builder->setDescription($this->payload2['description']);
        $this->builder->setDate($this->payload2['date']);
        $this->builder->save();

        $this->assertEquals($this->builder->getBalance(), 0 - $this->payload['amount'] - $this->payload2['amount']);
        $this->assertDatabaseHas('transactions', $this->payload2); 
    }

    /** @test */
    public function testCreditThenDebit()
    {
        $this->initialize();

        $this->builder->addCredit($this->payload['amount']);
        $this->builder->setDescription($this->payload['description']);
        $this->builder->setDate($this->payload['date']);
        $this->builder->save();

        $this->assertFalse(is_null($this->builder->getLast()));
        $this->assertEquals($this->builder->getBalance(), $this->payload['amount']);
        $this->assertDatabaseHas('transactions', $this->payload);

        $this->builder->addDebit($this->payload2['amount']);
        $this->builder->setDescription($this->payload2['description']);
        $this->builder->setDate($this->payload2['date']);
        $this->builder->save();

        $this->assertEquals($this->builder->getBalance(), $this->payload['amount'] - $this->payload2['amount']);
        $this->assertDatabaseHas('transactions', $this->payload2);
    }
}
