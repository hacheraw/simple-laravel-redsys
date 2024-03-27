<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Creagia\LaravelRedsys\Concerns\CanCreateRedsysRequests;
use Creagia\LaravelRedsys\Contracts\RedsysPayable;
use Illuminate\Support\Str;

class Order extends Model implements RedsysPayable
{
    use HasFactory;
    use CanCreateRedsysRequests;
    // use HasUuids; No se puede porque creagia/laravel-redsys sólo está preparado para primary keys numéricas

    protected $fillable = [
        'code',
        'title',
        'description',
        'amount',
        'is_paid',
        'paid_at',
    ];

    public function getTotalAmount(): int
    {
        return $this->amount * 100;
    }

    public function paidWithRedsys(): void
    {
        $this->is_paid = true;
        $this->paid_at = now();
        $this->save();
    }

    public static function booted() {
        static::creating(function ($model) {
            $model->code = Str::uuid();
        });
    }
}
