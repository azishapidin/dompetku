<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'account_id', 'date', 'type', 'amount', 'description', 'balance',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getFormattedBalanceAttribute()
    {
        $config = $this->account()->first(['currency', 'currency_placement']);

        return currencyFormat($this->getAttribute('balance'), $config->currency, $config->currency_placement);
    }

    public function getFormattedAmountAttribute()
    {
        $config = $this->account()->first(['currency', 'currency_placement']);

        return currencyFormat($this->getAttribute('amount'), $config->currency, $config->currency_placement);
    }

    public function getExcerptAttribute()
    {
        $length = 25;
        $description = $this->getAttribute('description');

        if (strlen($description) <= $length) {
            return $description;
        }

        return substr($description, 0, $length).'...';
    }
}
