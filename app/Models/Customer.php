<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['group_id', 'name', 'email', 'password', 'phone', 'is_active'];

    protected $hidden = ['password'];

    public function group()
    {
        return $this->belongsTo(CustomerGroup::class, 'group_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}