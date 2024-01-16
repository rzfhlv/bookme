<?php

namespace App\Models;

use App\Casts\Json;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_date',
        'amount_paid',
        'status',
        'request_payload',
        'response_payload',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
        'request_payload' => Json::class,
        'response_payload' => Json::class,
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => Carbon::parse($value)->format('d:m:Y H:i:s'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => Carbon::parse($value)->format('d:m:Y H:i:s'),
        );
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
