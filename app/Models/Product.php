<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'sale_price', 'stock', 'sku', 'image', 'is_active'];
    public function category() { return $this->belongsTo(Category::class); }
    public function inventory() { return $this->hasMany(Inventory::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
}