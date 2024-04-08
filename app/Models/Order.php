<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Creagia\LaravelRedsys\Concerns\CanCreateRedsysRequests;
use Creagia\LaravelRedsys\Contracts\RedsysPayable;
use Creagia\LaravelRedsys\Request as RedsysRequest;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return (int) number_format($this->amount, 2, '', '');
    }

    public function paidWithRedsys(): void
    {
        $this->is_paid = true;
        $this->paid_at = now();
        $this->save();
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(RedsysRequest::class, 'model_id', 'id');
    }

    // No puedo hacerlo como clave primaria porque creagia/laravel-redsys sólo acepta primary keys numericas
    public static function booted() {
        static::creating(function ($model) {
            $model->code = Str::uuid();
        });
    }
}
