<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'currency',
        'currency_placement',
        'balance',
    ];

    /**
     * Has many to Transaction.
     */
    public function transaction()
    {
        return $this->hasMany(\App\Model\Transaction::class);
    }

    /**
     * Get last transaction from account's transaction.
     */
    public function getLastTransaction()
    {
        return $this->transaction()->orderBy('id', 'desc')->first();
    }

    /**
     * Get balance with currency format.
     *
     * @return string Formatted Balance
     */
    public function getFormattedBalanceAttribute()
    {
        $balance = $this->balance;
        $currency = $this->currency;
        $position = $this->currency_placement;

        return currencyFormat($balance, $currency, $position);
    }
}
