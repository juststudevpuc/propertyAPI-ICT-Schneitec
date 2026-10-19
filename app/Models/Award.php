<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Award extends Model {
    protected $fillable = ['title', 'subtitle', 'year', 'icon_name', 'award_type', 'display_order'];
}
