<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestFeedback extends Model
{
    protected $table = 'guest_feedbacks'; // <-- Add this explicit table name

    protected $fillable = ['hotel_visited', 'name', 'email', 'message'];
}
