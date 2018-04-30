<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\Account;
use App\Model\Transaction;

/**
 * Transaction Builder.
 *
 * @author  Azis Hapidin <azishapidin@gmail.com>
 *
 * @link    https://azishapidin.com/
 */
class TransactionBuilder extends Controller
{
    /**
     * Account balance.
     *
     * @var decimal
     */
    protected $balance = 0;

    /**
     * Account model.
     *
     * @var \App\Model\Account
     */
    protected $account;

    /**
     * Last transaction on this Account.
     *
     * @var \App\Model\Transaction
     */
    protected $last;

    /**
     * Data payload.
     *
     * @var array
     */
    protected $payload;

    /**
     * Class constructor.
     *
     * @param \App\Model\Account $account Account Model
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->initializeData();
    }

    /**
     * Initialize balance and setup Transaction payload.
     */
    private function initializeData()
    {
        $last = $this->account->getLastTransaction();
        $this->balance = $this->account->balance;

        $this->setUpPayload();
    }

    /**
     * Setup payload to be stored in database.
     */
    protected function setUpPayload()
    {
        $this->payload = [
            'user_id'       => $this->account->user_id,
            'account_id'    => $this->account->id,
            'date'          => '',
            'amount'        => 0,
            'type'          => '',
            'description'   => '',
            'balance'       => $this->balance,
        ];
    }

    /**
     * Set amount, set type to db and decrease balance.
     *
     * @param decimal $amount Transaction amount
     */
    public function addDebit($amount = 0)
    {
        $this->payload['amount'] = $amount;
        $this->payload['type'] = 'db';
        $this->payload['balance'] -= $amount;
    }

    /**
     * Set amount, set type to cr and increase balance.
     *
     * @param decimal $amount Transaction amount
     */
    public function addCredit($amount = 0)
    {
        $this->payload['amount'] = $amount;
        $this->payload['type'] = 'cr';
        $this->payload['balance'] += $amount;
    }

    /**
     * Set payload description.
     *
     * @param string $description Transaction note
     */
    public function setDescription($description = '')
    {
        $this->payload['description'] = $description;
    }

    /**
     * Set payload date.
     *
     * @param string $date Transaction date
     */
    public function setDate($date = '')
    {
        $this->payload['date'] = $date;
    }

    /**
     * Store payload to database.
     *
     * @return \App\Model\Transaction
     */
    public function save()
    {
        $this->last = Transaction::create($this->payload);
        $this->account->balance = $this->last->balance;
        $this->account->save();
        $this->initializeData();

        return $this->last;
    }

    /**
     * Get last transaction.
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * Get balance of Account.
     *
     * @return int Account balance
     */
    public function getBalance()
    {
        return $this->balance;
    }
}
