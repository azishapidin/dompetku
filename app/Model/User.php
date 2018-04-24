<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all Account.
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Get deleted Account.
     */
    public function deletedAccounts()
    {
        return $this->accounts()->withTrashed()->whereNotNull('deleted_at')->get();
    }
}
