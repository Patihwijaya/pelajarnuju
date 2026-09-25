<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'payment_info' => 'array',
        'form_schema' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'event_start_date' => 'datetime',
        'event_end_date' => 'datetime',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
