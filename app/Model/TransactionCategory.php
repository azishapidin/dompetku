<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'parent_id', 'name', 'show_on_stats',
    ];

    /**
     * Parent of category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    /**
     * Child of category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * Has many to Transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(\App\Model\Transaction::class, 'category_id', 'id');
    }
}
