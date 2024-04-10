<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Thiagoprz\CompositeKey\HasCompositeKey;

class SizeProduct extends Model
{
    use HasFactory, Notifiable, HasUuids;

}
