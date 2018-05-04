<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

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
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        return $this->hasMany(\App\Model\Transaction::class);
    }

    /**
     * Get last transaction from account's transaction.
     *
     * @return \App\Model\Transaction
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

    /**
     * Override delete method.
     *
     * @return void
     */
    public function delete()
    {
        DB::transaction(function () {
            $this->transaction()->delete();
            parent::delete();
        });
    }

    /**
     * Override restore method.
     *
     * @return void
     */
    public function restore()
    {
        DB::transaction(function () {
            $this->transaction()->restore();
            parent::restore();
        });
    }
}
