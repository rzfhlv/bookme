<?php

namespace App\Models;

use App\Casts\AppointmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'conselor_id',
        'client_id',
        'schedule_id',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'status' => AppointmentStatus::class,
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

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
