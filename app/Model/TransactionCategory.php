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
        'id', 'user_id', 'parent_id', 'name'
    ];

    /**
     * Parent of category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(TransactionCategory::class, 'id', 'parent_id');
    }
}
