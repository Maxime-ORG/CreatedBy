<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'command_number',
        'date',
        'product_price'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
