<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class available_schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'day_id',
        'time_id',
    ];
}
