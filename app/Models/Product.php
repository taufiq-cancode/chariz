<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_image',
        'price',
        'cost_price',
        'description',
        'quantity',
        'sold_items',
        'sales_price',
        'images',
        'additional_info',
        'sku',
        'weight',
        'dimensions',
        'shipping_method',
        'shipping_cost',
        'shipping_time',
        'location',
        'status',
        'visibility'
    ];

    protected $casts = [
        'images'
    ];

    public function cartItem()
    {
        return $this->hasOne(CartItem::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getProfit()
    {
        if ($this->cost_price !== null) {
            return ($this->price - $this->cost_price) * $this->sold_items;
        }

        return null;
    }
}
