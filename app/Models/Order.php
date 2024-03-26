<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'is_paid',
        'paid_at',
    ];
}
