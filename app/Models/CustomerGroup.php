<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CustomerGroup extends Model
{
    protected $fillable = ['name', 'discount_percent', 'description', 'is_active'];
    public function customers() { return $this->hasMany(Customer::class, 'group_id'); }
}