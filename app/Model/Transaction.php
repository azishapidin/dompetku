<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * Set primary key.
     * 
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'account_id', 'date', 'type', 'amount', 'description', 'balance', 'category_id',
    ];

    /**
     * Relation to Account Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Has many to Transaction Attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachment()
    {
        return $this->hasMany(\App\Model\TransactionAttachment::class);
    }

    /**
     * Get balance with formatted currency.
     *
     * @return string Formatted balance
     */
    public function getFormattedBalanceAttribute()
    {
        $config = $this->account()->first(['currency', 'currency_placement']);

        return currencyFormat($this->getAttribute('balance'), $config->currency, $config->currency_placement);
    }

    /**
     * Get amount with formatted currency.
     *
     * @return string Formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        $config = $this->account()->first(['currency', 'currency_placement']);

        return currencyFormat($this->getAttribute('amount'), $config->currency, $config->currency_placement);
    }

    /**
     * Get description excerpt.
     *
     * @return string Description excerpt
     */
    public function getExcerptAttribute()
    {
        $length = 15;
        $description = $this->getAttribute('description');

        if (strlen($description) <= $length) {
            return $description;
        }

        return substr($description, 0, $length).'...';
    }

    /**
     * Relation to Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(TransactionCategory::class);
    }
}
