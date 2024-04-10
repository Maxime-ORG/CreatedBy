<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'story',
        'price',
        'quantity',
        'image',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products', 'product_id', 'color_id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_products', 'product_id', 'material_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_products', 'product_id', 'size_id');
    }
}
