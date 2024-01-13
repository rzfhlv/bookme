<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'conselor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
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

    public function conselor(): BelongsTo
    {
        return $this->belongsTo(Conselor::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
