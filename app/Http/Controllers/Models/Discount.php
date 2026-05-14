<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['code', 'type', 'value', 'customer_group_id', 'min_quantity', 'starts_at', 'expires_at', 'is_active'];

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class);
    }
}
