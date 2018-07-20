<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Module\TransactionBuilder;

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

    /**
     * Transfer money to another account.
     * 
     * @return void
     */
    public function transfer(
        Account $account,
        $amount = 0, 
        $categoryId = null, 
        $date = '', 
        $description = ''
    ) {
        $payload = [
            'account' => [
                'origin' => $this,
                'destination' => $account,
            ],
            'amount' => $amount,
            'category_id' => $categoryId,
            'date' => $date,
            'description' => 'Transfer from ' . $this->name . ' to ' . $account->name . ': ' . $description,
        ];

        \DB::transaction(function() use($payload) {
            // Decrease Origin
            $builder = new TransactionBuilder($payload['account']['origin']);
            $builder->addDebit($payload['amount']);
            if (isset($payload['category_id']) && !is_null($payload['category_id'])) {
                $builder->setCategory($payload['category_id']);
            }
            $builder->setDescription($payload['description']);
            $builder->setDate($payload['date']);
            $builder->save();

            // Increase Destination
            $builder = new TransactionBuilder($payload['account']['destination']);
            $builder->addCredit($payload['amount']);
            if (isset($payload['category_id']) && !is_null($payload['category_id'])) {
                $builder->setCategory($payload['category_id']);
            }
            $builder->setDescription($payload['description']);
            $builder->setDate($payload['date']);
            $builder->save();
        });
    }
}
