<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingInquiry extends Model
{
    protected $fillable = ['property_id', 'check_in', 'check_out', 'guests', 'status'];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
