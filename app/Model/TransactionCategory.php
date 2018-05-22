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
        'id', 'parent_id', 'name'
    ];
}
