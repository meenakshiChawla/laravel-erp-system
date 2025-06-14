<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {
    use HasFactory;
    protected $fillable = ['name', 'sku', 'price', 'quantity'];
    public function salesOrders()
    {
        return $this->belongsToMany(SalesOrder::class, 'product_sales_order')
                ->withPivot('quantity','price')
                ->withTimestamps();
    }
}
